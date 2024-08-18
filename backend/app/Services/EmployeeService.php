<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmployeeService
{
    public function __construct(protected EmployeeRepository $employeeRepository)
    {
    }

    public function index(array $options) : LengthAwarePaginator
    {
        return $this->employeeRepository->index($options);
    }

    public function show(string $id) : Employee
    {
        return $this->employeeRepository->getItemById($id);
    }

    public function store(array $newEmployeeData) : Employee
    {
        return $this->employeeRepository->store($newEmployeeData);
    }

    public function update(string $id, array $newEmployeeData) : Employee
    {
        return $this->employeeRepository->update($id, $newEmployeeData);
    }

    public function delete(string $id) : void
    {
        $this->employeeRepository->delete($id);
    }
}