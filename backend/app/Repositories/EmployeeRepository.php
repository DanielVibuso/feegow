<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmployeeRepository extends Repository
{
    /**
     * @param Employee $employee
     */
    public function __construct(protected Employee $employee)
    {
        $this->model = $employee;
    }

}
