<?php

namespace App\Services;

use Illuminate\Pagination\Paginator;
use App\Exceptions\EarlyToBoosterException;
use App\Exceptions\LotExpiredException;
use App\Exceptions\SingleShotException;
use App\Pivots\EmployeeLot;
use App\Repositories\EmployeeRepository;
use App\Repositories\LotRepository;
use App\Repositories\VaccineRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmployeeLotService
{
    public function __construct(protected EmployeeRepository $employeeRepository,
                                protected LotRepository $lotRepository,
                                protected VaccineRepository $vaccineRepository,
                                )
    {
    }

     /**
    * This method will verify if the date applied is compatible with the booster recommended date
    *
    * @param string $employee The employee identifier or instance.
    * @param string $applied_at The date when the shot was applied.
    * @return int The current shot number.
    */
    private function isEarlyToBooster(string $employee, string $appliedAt)
    {
        $appliedLots = $this->employeeRepository->getItemById($employee)->lots;
        if (count($appliedLots) > 0 && $appliedLots->last()->pivot->next_shot > $appliedAt) {
            throw new EarlyToBoosterException();
        }
    }

    /**
    * This method will process the amount of applied shots and calc the current shot number
    *
    * @param string $employee The employee identifier or instance.
    * @return int The current shot number.
    */
    private function calcShotNumber(string $employee)
    {
        $appliedLots = $this->employeeRepository->getItemById($employee)->lots;
        if (!$appliedLots) {
            return 1;
        }

        return count($appliedLots) + 1;

    }

    /**
     * this  method will process the interval registred to that vaccine type and calc the next shot date
     * if it is one shot type vaccine, will return null
     * 
     * @param string $lot The lot id.
     * @param string $applied_at The date when the shot was applied.
     * @return string|null  the next date or null
     */
    private function calcDateNextShot(string $lot, string $applied_at) : string | null
    {
        $vaccine = $this->lotRepository->getItemById($lot)->vaccine;

        if(!$vaccine->booster_interval){
            return null;
        }

        $appliedAt = Carbon::parse($applied_at); 
        $nextShot = $appliedAt->addDays($vaccine->booster_interval);
        return $nextShot->format('Y-m-d');
    }

    /**
     * This method will throw an exception if the applied shot is less than lot's expiration date
     * 
     * @param string $lot The lot id.
     * @param string $applied_at The date when the shot was applied.
     * @return string|null  the next date or null
     */
    private function isAppliedDateLessThanExpirationDate(string $lot, string $applied_at)
    {
        $lot = $this->lotRepository->getItemById($lot);

        if( $lot->expiration < $applied_at){
            throw new LotExpiredException();
        }
    }


    public function attach(array $shotData,string $employee, string $lot)
    {
        $this->isAppliedDateLessThanExpirationDate($lot, $shotData['applied_at']);

        $shotData['shot_number'] = $this->calcShotNumber($employee);

        $shotData['next_shot'] = $this->calcDateNextShot($lot, $shotData['applied_at']);

        if (!$shotData['next_shot'] && $shotData['shot_number'] > 1) {
            throw new SingleShotException();
        }

        $this->isEarlyToBooster($employee, $shotData['applied_at']);

        $this->employeeRepository->getItemById($employee)->lots()->attach($lot, $shotData);

        return $this->employeeRepository->getItemById($employee);
    }

    public function detach(string $employee, string $lot)
    {
        $this->employeeRepository->getItemById($employee)->lots()->detach($lot);
    }

    public function index(string $employee): LengthAwarePaginator
    {
        //TODO::repository? manual pagination on collection?
        return EmployeeLot::where('employee_id', $employee)->paginate(15);
    }

    public function update(array $newDataShoot, string $employee, string $lot)
    {
        return $this->employeeRepository->getItemById($employee)->lots()->updateExistingPivot($lot, $newDataShoot);
    }
}