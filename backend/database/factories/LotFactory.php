<?php

namespace Database\Factories;

use App\Models\Lot;
use App\Models\Vaccine; // Assumindo que existe um modelo Vaccine
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LotFactory extends Factory
{
    protected $model = Lot::class;

    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'vaccine_id' => Vaccine::factory(), 
            'lot_identify' => strtoupper($this->faker->bothify('##??####')),
            'expiration' => $this->faker->dateTimeBetween('+1 year', '+2 years')->format('Y-m-d'),
            'is_valid' => $this->faker->boolean(80), 
        ];
    }
}