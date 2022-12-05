<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Account model.
 *
 * @package App\Models
 */
class Account extends Model {

    use HasFactory;

    protected $fillable = [
        "name",
        "balance",
        "iban",
        "type"
    ];

    public function transactions()
    {
        return $this -> hasMany(Transaction::class);
    }
}
