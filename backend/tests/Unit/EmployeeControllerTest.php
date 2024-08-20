<?php

namespace Tests\Unit;

use App\Http\Controllers\EmployeeController;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Mockery;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $employeeService;
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();

        ////Arrange -Service mock
        $this->employeeService = Mockery::mock(EmployeeService::class);
        
        //Arrange -controller instance
        $this->controller = new EmployeeController($this->employeeService);
    }

    public function testStoreEmployeeSuccess()
    {
        // data to mock
        $employeeData = [
            'id' => Str::uuid(),
            'name' => 'Daniel', 
            'middle_name' => 'Developer', 
            'last_name' => 'Da Silva', 
            'cpf' => '51185410007',
            'birth_date' => '1995-05-03',
            'comorbidity' => false
        ];

        //Arrange - mock Model Employee
        $employee = Mockery::mock(Employee::class)->makePartial();
        $employee->shouldReceive('getAttribute')->andReturnUsing(function ($key) use ($employeeData) {
            return $employeeData[$key];
        });
        $employee->shouldReceive('toArray')->andReturn($employeeData);


        //Arrange -mock employee service
        $this->employeeService->shouldReceive('store')
            ->once()
            ->with($employeeData)
            ->andReturn($employee);

        //Arrange -  mock EmployeeResource
        $employeeResource = Mockery::mock(EmployeeResource::class, function ($mock) use ($employee) {
            $mock->shouldReceive('resolve')->andReturn($employee->toArray());
        });

        //Arrange: StoreRequest Mock
        $request = Mockery::mock(StoreRequest::class);
        $request->shouldReceive('validated')->andReturn($employeeData);

        //act
        $response = $this->controller->store($request);

        $this->assertInstanceOf(EmployeeResource::class, $response);

        //assert
        $this->assertEquals($employeeResource->resolve(), $response->resolve());
    }

    public function testStoreEmployeeFailure()
    {
        //mock prepare
        $this->employeeService->shouldReceive('store')
            ->once()
            ->andThrow(new \Exception('Error storing employee'));

        $employeeData = [
            'name' => 'Daniel', 
            'middle_name' => 'Developer', 
            'last_name' => 'Da Silva', 
            'cpf' => '51185410007',
            'birth_date' => '1995-05-03',
            ];

        //mock prepare
        $request = Mockery::mock(StoreRequest::class);
        $request->shouldReceive('validated')->andReturn($employeeData);

        //unit testing
        $response = $this->controller->store($request);

        $expectedJson = [
            "message" => "O campo comorbidity é obrigatório.",
            "errors" => [
                "comorbidity" => [
                    "O campo comorbidity é obrigatório."
                ]
            ]
        ];

        //asserting
        $this->assertEquals(422, $response->status());
        $this->assertJson($response->getContent(), json_encode($expectedJson));

    }

}