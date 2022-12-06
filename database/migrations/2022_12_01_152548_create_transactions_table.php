<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema ::create('transactions', function (Blueprint $table) {
            $table -> id();
            $table -> foreignIdFor(\App\Models\Account::class);
            $table -> string('description');
            $table -> decimal('amount');
            $table -> dateTime('date');
            $table -> string('type') -> nullable(); //Electronic, Cash, Cheque
            $table -> string('category') -> nullable();
            $table -> string('notes') -> nullable();
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema ::dropIfExists('transactions');
    }
}
