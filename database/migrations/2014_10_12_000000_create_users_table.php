<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->tinyInteger('gender')->default(0);//lan
            $table->date('dob')->nullable();//lan
            $table->string('avatar_path')->nullable()->default(null);//lan
            $table->string('id_card_front')->nullable()->default(null);//lan
            $table->string('id_card_back')->nullable()->default(null);//lan

            $table->string('avatar')->default('asset/default/user.jpg');
            $table->string('nickname')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id');//lan
            $table->double('coin')->nullable();//lan
            $table->float('salary_per_month')->nullable();//lan
            $table->string('description')->nullable();//lan
            $table->tinyInteger('active')->default(0);
            $table->string('address')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
