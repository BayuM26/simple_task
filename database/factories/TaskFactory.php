<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => $this->faker->numberBetween(1,20),
            'id_category' => $this->faker->numberBetween(1,20),
            'task_name' => $this->faker->jobTitle(),
            'deskrip_task' => $this->faker->text(),
            'status' => 'inconclusive',
        ];
    }
}
