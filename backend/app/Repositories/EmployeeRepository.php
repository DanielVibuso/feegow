<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmployeeRepository
{
    /**
     * @param Employee $employee
     */
    public function __construct(protected Employee $employee)
    {
    }

    /**
     * @return LengthAwarePaginator return the employees paginated
     */
    public function index(array $options): LengthAwarePaginator
    {
        return $this->employee->when(isset($options['sort']), function ($query) use ($options) {
            $query->orderBy($options['sort'], $options['order'] ?? 'asc');
        })->paginate($options['perPage'] ?? 15);
    }

    /**
     * @param array $newEmployeeData
     *
     * @return Employee
     */
    public function store(array $newEmployeeData) : Employee
    {
        return $this->employee->create($newEmployeeData);
    }

    /**
     * @param array $newEmployeeData
     *
     * @return Employee
     */
    public function update(string $id,  array $newEmployeeData) : Employee
    {
        $employee = $this->getEmployeeById($id);
        $employee->update($newEmployeeData);

        return $employee;
    }    
    
    /**
     * @param string $id
     *
     * @return Employee
     */
    public function getEmployeeById(string $id): Employee
    {
        return $this->employee->where('id', $id)->firstOrFail();
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function delete(string $id): void
    {
        $this->getEmployeeById($id)->delete();
    }

}
