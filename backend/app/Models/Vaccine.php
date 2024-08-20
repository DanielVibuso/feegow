<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Vaccine extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UsesUuid;

    protected $guarded = [];

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }

    public function scopeFilterList(Builder $query, $options = [])
    {
        return $query->when(!empty($options['name']), function ($query) use ($options) {
            $query->where('name', $options['name']);
        });
    }
}
