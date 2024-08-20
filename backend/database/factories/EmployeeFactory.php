<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'cpf' => $this->faker->unique()->numerify('###########'),
            'name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'birth_date' => $this->faker->date('Y-m-d', '2000-01-01'),
            'comorbidity' => $this->faker->boolean(),
        ];
    }
}