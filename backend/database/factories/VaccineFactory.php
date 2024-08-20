<?php

namespace Database\Factories;

use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VaccineFactory extends Factory
{
    protected $model = Vaccine::class;

    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'name' => $this->faker->company . 'VAX', 
            'booster_interval' => $this->faker->numberBetween(0, 365),
        ];
    }
}