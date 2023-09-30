<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class m_category_taskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_name' => $this->faker->jobTitle(),
        ];
    }
}
