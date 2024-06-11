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
        Schema::create('type_subscriptions', function (Blueprint $table) {
            $table->id('id_type');
            $table->enum('type', ['FREE','PLUS', 'PRO'])->default('FREE');
            $table->integer('duration');
            $table->double('price', 4, 2);
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
        Schema::dropIfExists('type_subscriptions');
    }
};
