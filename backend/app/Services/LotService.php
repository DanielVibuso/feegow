<?php

namespace App\Services;

use App\Models\Lot;
use App\Repositories\LotRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LotService
{
    public function __construct(protected LotRepository $lotRepository)
    {
    }

    public function index(array $options) : LengthAwarePaginator
    {
        return $this->lotRepository->index($options);
    }

    public function show(string $id) : Lot
    {
        return $this->lotRepository->getItemById($id);
    }

    public function store(array $newLotData) : Lot
    {
        if ($newLotData['expiration'] < now()) {
            $newLotData['is_valid'] = false;
        }
        
        return $this->lotRepository->store($newLotData);
    }

    public function update(string $id, array $newLotData) : Lot
    {
        return $this->lotRepository->update($id, $newLotData);
    }

    public function delete(string $id) : void
    {
        $this->lotRepository->delete($id);
    }
}