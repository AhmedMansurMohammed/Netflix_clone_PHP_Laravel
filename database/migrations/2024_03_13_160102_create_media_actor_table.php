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
        Schema::create('media_actors', function (Blueprint $table) {
            $table->unsignedBigInteger('id_person');
            $table->unsignedBigInteger('id_media');
            $table->primary(['id_person', 'id_media']);
            $table->foreign('id_person')->references('id_person')->on('peoples')->onDelete('cascade');
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
        Schema::dropIfExists('media_actors');
    }
};
