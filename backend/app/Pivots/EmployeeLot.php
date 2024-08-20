<?php

namespace App\Pivots;

use App\Models\Employee;
use App\Models\Lot;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EmployeeLot extends Pivot
{
    use UsesUuid;

    protected $table = 'employee_lot';
    
    public function lot(){
        return $this->belongsTo(Lot::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}