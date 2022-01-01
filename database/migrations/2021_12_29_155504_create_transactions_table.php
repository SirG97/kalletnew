<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('trx_ref');
            $table->enum('txn_type', ['credit','debit']);
            $table->enum('purpose',['deposit', 'transfer', 'withdrawal', 'reversal', 'payment']);
            $table->unsignedFloat('amount', 20, 4);
            $table->unsignedFloat('balance_before', 20, 2);
            $table->unsignedFloat('balance_after', 20, 2);
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
