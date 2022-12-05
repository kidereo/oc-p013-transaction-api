<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this -> faker -> randomElement(['Electronic', 'Cash', 'Cheque']);

        return [
            'account_id'  => Account ::factory(),
            'description' => $this -> faker -> company,
            'amount'      => $this -> faker -> randomFloat(2, 5, 200),
            'date'        => $this -> faker -> dateTimeThisDecade(),
            'type'        => $type
        ];
    }
}
