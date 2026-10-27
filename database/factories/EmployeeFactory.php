<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        $departments = [
            'IT',
            'HRD',
            'Finance',
            'Marketing',
            'Operations',
        ];

        $positions = [
            'Staff',
            'Senior Staff',
            'Supervisor',
            'Manager',
            'Team Leader',
        ];

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'position' => fake()->randomElement($positions),
            'department' => fake()->randomElement($departments),
        ];
    }
}
