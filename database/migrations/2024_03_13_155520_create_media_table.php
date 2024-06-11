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
        Schema::create('medias', function (Blueprint $table) {
            $table->id('id_media');
            $table->string('title', 255);
            $table->text('description');
            $table->year('release_year');
            $table->integer('likes')->default(0);

            $table->unsignedBigInteger('director');
            $table->foreign('director')->references('id_person')->on('peoples');

            $table->string('img_url', 255);
            $table->boolean('isSerie')->default(false);

            $table->unsignedBigInteger('country');
            $table->foreign('country')->references('id_country')->on('countries')->onDelete('cascade');

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
        Schema::dropIfExists('medias');
    }
};
