<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('user_upload');
            $table->unsignedBigInteger('album_id')->default(0);
            $table->text('description')->nullable();
            $table->longText('lyrics')->nullable();
            $table->string('thumbnail')->default('asset/default/music.jpg');
            $table->string('file_path');
            $table->text('time')->nullable();
            $table->integer('views')->default(0);
            $table->integer('free')->default(1);
            $table->integer('is_recommended')->default(0);
            $table->foreign('user_upload')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('music');
    }
}
