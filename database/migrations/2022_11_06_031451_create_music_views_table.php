<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_views', function (Blueprint $table) {
            $table->unsignedBigInteger('music_id');
            $table->foreign('music_id')->references('id')->on('music');
            $table->dateTime('created_at')->default(date("Y-m-d H:i:s"));
            $table->dateTime('updated_at')->default(date("Y-m-d H:i:s"));
            $table->primary(['music_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('music_views');
    }
}
