<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebpayplusNormalResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webpayplus_normal_responses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('webpayplus_normal_transaction_id')->constrained();
            $table->string('buy_order', 26)->nullable(true);
            $table->string('session_id', 61)->nullable(true);
            $table->integer('amount')->nullable(true);
            $table->dateTimeTz('transaction_date')->nullable(true);
            $table->date('accounting_date')->nullable(true);
            $table->string('vci', 10)->nullable(true);
            $table->string('card_number', 16)->nullable(true);
            $table->date('card_expiration_date')->nullable(true);
            $table->string('authorization_code', 6)->nullable(true);
            $table->string('payment_type_code', 3)->nullable(true);
            $table->tinyInteger('response_code')->nullable(true);
            $table->string('response_description', 50)->nullable(true);
            $table->tinyInteger('shares_number')->nullable(true);

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
        Schema::dropIfExists('webpayplus_normal_responses');
    }
}
