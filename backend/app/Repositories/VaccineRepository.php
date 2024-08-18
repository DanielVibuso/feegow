<?php

namespace App\Repositories;

use App\Models\Vaccine;

class VaccineRepository extends Repository
{
    /**
     * @param Vaccine $vaccine
     */
    public function __construct(protected Vaccine $vaccine)
    {
        $this->model = $vaccine;
    }

}
