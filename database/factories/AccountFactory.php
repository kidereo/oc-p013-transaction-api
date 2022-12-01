<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Argent Bank Account',
            'iban'=>$this->faker->iban,
            'balance' => $this->faker->randomFloat(2,-10000, 10000)
        ];
    }
}
