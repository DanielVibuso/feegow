<?php

namespace App\Models;

use App\Pivots\EmployeeLot;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UsesUuid;

    protected $guarded = [];

    public function lots(): BelongsToMany
    {
        return $this->belongsToMany(Lot::class, 'employee_lot')
            ->using(EmployeeLot::class)
            ->withPivot(['lot_id', 'employee_id', 'applied_at', 'shot_number', 'next_shot'])
            ->withTimestamps();
    }

    public function scopeFilterList(Builder $query, $options = [])
    {
        return $query->when(!empty($options['cpf']), function ($query) use ($options) {
            $query->where('cpf', $options['cpf']);
        });
    }
}
