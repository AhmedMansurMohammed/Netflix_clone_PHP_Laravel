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
        Schema::create('media_genres', function (Blueprint $table) {
            $table->unsignedBigInteger('id_media');
            $table->unsignedBigInteger('id_genre');
            $table->primary(['id_media', 'id_genre']);
            $table->foreign('id_media')->references('id_media')->on('medias')->onDelete('cascade');
            $table->foreign('id_genre')->references('id_genre')->on('genres')->onDelete('cascade');
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
        Schema::dropIfExists('media_genres');
    }
};
