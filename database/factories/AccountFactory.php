<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $accountType = $this -> faker -> randomElement(['Checking', 'Saving', 'Credit']);
        $iban = $this -> faker -> iban;
        $accountNumber = substr($iban, - 4);

        return [
            'name'    => 'Argent Bank ' . $accountType . ' (x' . $accountNumber . ')',
            'iban'    => $iban,
            'balance' => $this -> faker -> randomFloat(2, - 10000, 10000)
        ];
    }
}
