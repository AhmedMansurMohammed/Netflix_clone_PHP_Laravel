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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id('id_episode');
            $table->string('url', 255);
            $table->string('title', 255);
            $table->integer('duration');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('id_media');
            $table->integer('season')->nullable();
            $table->foreign('id_media')->references('id_media')->on('medias')->onDelete('cascade');
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
        Schema::dropIfExists('episodes');
    }
};
