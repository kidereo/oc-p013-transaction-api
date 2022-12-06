<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Transaction model.
 * @package App\Models
 */
class Transaction extends Model {

    use HasFactory;

    protected $fillable = [
        'account_id',
        'description',
        'amount',
        'date',
        'type',
        'category',
        'notes',
        'created_at',
        'updated_at'
    ];

    public function account()
    {
        return $this -> belongsTo(Account::class);
    }
}
