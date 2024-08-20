<?php

namespace App\Models;

use App\Pivots\EmployeeLot;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Lot extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UsesUuid;

    protected $guarded = [];

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_lot')
            ->using(EmployeeLot::class)
            ->withPivot(['lot_id', 'employee_id'])
            ->withTimestamps();
    }

    public function scopeFilterList(Builder $query, $options = [])
    {
        return $query->when(!empty($options['vaccine_id']), function ($query) use ($options) {
            $query->where('vaccine_id', $options['vaccine_id']);
        })->when(!empty($options['lot_identify']), function ($query) use ($options) {
            $query->where('lot_identify', $options['lot_identify']);
        });
    }
}
