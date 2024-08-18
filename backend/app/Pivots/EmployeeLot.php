<?php

namespace App\Pivots;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EmployeeLot extends Pivot
{
    use UsesUuid;

    protected $table = 'employee_lot';
}