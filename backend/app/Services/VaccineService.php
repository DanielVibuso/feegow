<?php

namespace App\Services;

use App\Models\Vaccine;
use App\Repositories\VaccineRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VaccineService
{
    public function __construct(protected VaccineRepository $vaccineRepository)
    {
    }

    public function index(array $options) : LengthAwarePaginator
    {
        return $this->vaccineRepository->index($options);
    }

    public function show(string $id) : Vaccine
    {
        return $this->vaccineRepository->getItemById($id);
    }

    public function store(array $newVaccineData) : Vaccine
    {
        return $this->vaccineRepository->store($newVaccineData);
    }

    public function update(string $id, array $newVaccineData) : Vaccine
    {
        return $this->vaccineRepository->update($id, $newVaccineData);
    }

    public function delete(string $id) : void
    {
        $this->vaccineRepository->delete($id);
    }
}