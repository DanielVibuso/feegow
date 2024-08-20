<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class EmployeeFeaturesTest extends TestCase
{
    use RefreshDatabase;

    public function testListEmployee(): void
    {
        //Arrange
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*'] 
        );

        $employeeData = [
            'name' => 'Daniel', 
            'middle_name' => 'Developer', 
            'last_name' => 'Da Silva', 
            'cpf' => '51185410007',
            'birth_date' => '1995-05-03',
            'comorbidity' => false
        ];

        //arrange
        $response = $this->postJson('/api/employee', $employeeData);
        
        //arrange
        $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'name',
                'middle_name',
                'last_name',
                'cpf',
                'birth_date',
                'comorbidity',
                'id',
            ],
        ]);


        //test
        $response = $this->getJson('/api/employee');
        $expectedStructure = [
            'data' => [
                [
                    'id',
                    'cpf',
                    'name',
                    'middle_name',
                    'last_name',
                    'birth_date',
                    'comorbidity',
                ]
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next'
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'links' => [
                    [
                        'url',
                        'label',
                        'active'
                    ]
                ],
                'path',
                'per_page',
                'to',
                'total'
            ]
        ];

        $response->assertStatus(200)
        ->assertJsonStructure($expectedStructure);
    }

    public function testCreateEmployeeSuccess(): void
    {
        //Arrange
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*'] 
        );

        $employeeData = [
            'name' => 'Daniel', 
            'middle_name' => 'Developer', 
            'last_name' => 'Da Silva', 
            'cpf' => '51185410007',
            'birth_date' => '1995-05-03',
            'comorbidity' => false
        ];

        //act
        $response = $this->postJson('/api/employee', $employeeData);
        
        //test
        $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'name',
                'middle_name',
                'last_name',
                'cpf',
                'birth_date',
                'comorbidity',
                'id',
            ],
        ]);
    }

    public function testCreateEmployeeFail(): void
    {
        //Arrange
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*'] 
        );

        $employeeWrongData = [
            'name' => 'Daniel', 
            'middle_name' => 'Developer', 
            'last_name' => 'Da Silva', 
            'cpf' => '51185410007',
        ];

        //act
        $response = $this->postJson('/api/employee', $employeeWrongData);
        
        //assert. 
        //I'd rather test the structure than the exacly body response, 
        //'cause if we are treating with multi language response it would be simplified and safe
        $response->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => [
                'birth_date',
                'comorbidity',
            ],
        ]);
    }



    public function testUpdateEmployeeSuccess(): void
    {
        //Arrange
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*'] 
        );

        $employeeData = [
            'name' => 'Daniel', 
            'middle_name' => 'Developer', 
            'last_name' => 'Da Silva', 
            'cpf' => '51185410007',
            'birth_date' => '1995-05-03',
            'comorbidity' => false
        ];

        //Arrange
        $response = $this->postJson('/api/employee', $employeeData);
        
        //Arrange
        $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'name',
                'middle_name',
                'last_name',
                'cpf',
                'birth_date',
                'comorbidity',
                'id',
            ],
        ]);

        //arrange
        $employeeToUpdate = json_decode($response->getContent());


        //act
        $employeNewName = [
            'name' => 'AlteredName', 
        ];
        $response = $this->putJson("/api/employee/{$employeeToUpdate->data->id}", $employeNewName);

        //assert
        $response->assertStatus(200)
                 ->assertJsonFragment($employeNewName);
    }



    public function testDeleteEmployeeSuccess(): void
    {
        //Arrange
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*'] 
        );

        $employeeData = [
            'name' => 'Daniel', 
            'middle_name' => 'Developer', 
            'last_name' => 'Da Silva', 
            'cpf' => '51185410007',
            'birth_date' => '1995-05-03',
            'comorbidity' => false
        ];

        //Arrange
        $response = $this->postJson('/api/employee', $employeeData);
        
        //Arrange
        $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'name',
                'middle_name',
                'last_name',
                'cpf',
                'birth_date',
                'comorbidity',
                'id',
            ],
        ]);

        //arrange
        $employeeToDelete = json_decode($response->getContent());


        //act
        $response = $this->DeleteJson("/api/employee/{$employeeToDelete->data->id}");

        $response->assertStatus(204);
    }
}
