<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'name' => 'Bayu Maulana',
            // 'username' => 'admin',
            // 'password' => bcrypt(env('PASSWORDTAMBAHAN').'admin'.env('PASSWORDTAMBAHAN')),
            // 'hak_akses' => 'admin',
            'name' => $this->faker->unique()->name(),
            'username' => $this->faker->unique()->userName(),
            'password' => bcrypt(env('PASSWORDTAMBAHAN').$this->faker->password().env('PASSWORDTAMBAHAN')),
            'hak_akses' => 'Employee',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
