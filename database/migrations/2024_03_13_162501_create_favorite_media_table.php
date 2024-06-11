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
        Schema::create('favorite_medias', function (Blueprint $table) {
            $table->unsignedBigInteger('id_media');
            $table->unsignedBigInteger('id_user');
            
            $table->primary(['id_media', 'id_user']);
            
            $table->foreign('id_media')->references('id_media')->on('medias')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('favorite_medias');
    }
};
