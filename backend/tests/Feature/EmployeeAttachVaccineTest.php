<?php

namespace Tests\Feature;

use App\Exceptions\EarlyToBoosterException;
use App\Exceptions\LotExpiredException;
use App\Exceptions\SingleShotException;
use App\Models\Employee;
use App\Models\Lot;
use App\Models\Vaccine;
use App\Repositories\EmployeeRepository;
use App\Repositories\LotRepository;
use App\Repositories\VaccineRepository;
use App\Services\EmployeeLotService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeAttachVaccineTest extends TestCase
{
    use RefreshDatabase;

    protected $employeeLotService;
    protected $employeeRepository;
    protected $lotRepository;
    protected $vaccineRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->employeeRepository = app(EmployeeRepository::class);
        $this->lotRepository = app(LotRepository::class);
        $this->vaccineRepository = app(VaccineRepository::class);

        $this->employeeLotService = new EmployeeLotService(
            $this->employeeRepository,
            $this->lotRepository,
            $this->vaccineRepository
        );
    }

    public function testAttachEmployeeToVaccineSuccess(): void
    {
        $employee = Employee::factory()->create();
        $lot = Lot::factory()->create();

        $result = $this->employeeLotService->attach(['applied_at' => now()], $employee->id, $lot->id);

        $this->assertEquals($result->id, $employee->id);
        
    }

    public function testAttachEmployeeToVaccineTooEarlyException(): void
    {
        $employee = Employee::factory()->create();
        $lot = Lot::factory()->create();

        $result = $this->employeeLotService->attach(['applied_at' => now()], $employee->id, $lot->id);

        $this->assertEquals($result->id, $employee->id);

        $this->expectException(EarlyToBoosterException::class);

        $result = $this->employeeLotService->attach(['applied_at' => now()], $employee->id, $lot->id);
    }

    public function testAttachEmployeeToVaccineLotExpiredException(): void
    {
        $employee = Employee::factory()->create();
        $lot = Lot::factory()->create();

        $expirationDate = Carbon::parse($lot->expiration);

        $result = $this->employeeLotService->attach(['applied_at' => now()], $employee->id, $lot->id);

        $this->assertEquals($result->id, $employee->id);

        $this->expectException(LotExpiredException::class);

        $result = $this->employeeLotService->attach(['applied_at' => $expirationDate->addDays(10)], $employee->id, $lot->id);
    }


    public function testAttachEmployeeToVaccineSingleShotException(): void
    {
        $employee = Employee::factory()->create();
        $vaccine = Vaccine::factory()->create(['name'=> 'coronax','booster_interval' => 0]);
        $lot = Lot::factory()->create(['vaccine_id' => $vaccine->id]);

        $expirationDate = Carbon::parse($lot->expiration);

        $result = $this->employeeLotService->attach(['applied_at' => $expirationDate->subDays(100)], $employee->id, $lot->id);

        $this->assertEquals($result->id, $employee->id);

        $this->expectException(SingleShotException::class);

        $result = $this->employeeLotService->attach(['applied_at' => now()], $employee->id, $lot->id);
    }

   
}
