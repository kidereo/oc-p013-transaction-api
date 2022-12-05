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
        //$balance = $accountType == "Saving" ? $this -> faker -> randomFloat(2, 10, 100000) : $this -> faker -> randomFloat(2, - 10000, 10000);
        if ($accountType == "Saving")
        {
            $balance = $this -> faker -> randomFloat(2, 10, 100000);
        } elseif ($accountType == "Credit")
        {
            $balance = $this -> faker -> randomFloat(2, - 10000, 0);
        } else
        {
            $balance = $this -> faker -> randomFloat(2, - 10000, 10000);
        }
        $iban = $this -> faker -> iban("FR", "ARGB");

        return [
            'name'    => 'Argent Bank ' . $accountType . ' (x' . substr($iban, - 4) . ')',
            'iban'    => $iban,
            'type'    => $accountType,
            'balance' => $balance
        ];
    }
}
