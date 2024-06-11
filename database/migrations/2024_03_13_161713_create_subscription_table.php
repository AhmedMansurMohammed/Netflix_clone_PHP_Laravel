<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id('id_subscription'); 

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users');

            $table->unsignedBigInteger('id_type');
            $table->foreign('id_type')->references('id_type')->on('type_subscriptions');

            $table->string('entity', 255);
            $table->string('account_number', 255);
            $table->date('start_date')->default(now());
            $table->date('expire_date'); 

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
        Schema::dropIfExists('subscriptions');
    }
};
