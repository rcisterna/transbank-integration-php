<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOneclickNormalUserResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oneclick_normal_user_responses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('oneclick_normal_user_id')->constrained();
            $table->string('authorization_code', 6)->nullable(true);
            $table->string('credit_card_type', 20)->nullable(true);
            $table->string('last_card_digits', 4)->nullable(true);
            $table->tinyInteger('response_code')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oneclick_normal_user_responses');
    }
}
