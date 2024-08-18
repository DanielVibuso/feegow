<?php

namespace App\Repositories;

use App\Models\Lot;

class LotRepository extends Repository
{
    /**
     * @param Lot $lot
     */
    public function __construct(protected Lot $lot)
    {
        $this->model = $lot;
    }

}
