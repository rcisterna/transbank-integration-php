<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOneclickNormalAuthorizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oneclick_normal_authorizations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('payment_id')->constrained();
            $table->foreignId('oneclick_normal_user_id')->constrained();
            $table->string('authorization_code', 6)->nullable(true);
            $table->string('credit_card_type', 20)->nullable(true);
            $table->string('last_card_digits', 4)->nullable(true);
            $table->bigInteger('transaction_id')->nullable(true);
            $table->tinyInteger('response_code')->nullable(true);

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
        Schema::dropIfExists('oneclick_normal_authorizations');
    }
}
