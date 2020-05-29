<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebpayplusNormalTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webpayplus_normal_transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('payment_id')->constrained();
            $table->string('token', 64)->nullable(true);
            $table->text('error')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webpayplus_normal_transactions');
    }
}
