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
            $table->string('atas_nama')->nullable();
            $table->bigInteger('nomor_rekening')->nullable();
            $table->string('username')->unique()->nullable();
            $table->integer('balance')->unsigned()->default(0);
            $table->integer('point')->unsigned()->default(0);
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('last_seen')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('nomorhp')->unique();
            $table->timestamp('nomorhp_verified_at')->nullable();
            $table->foreignId('ktp_id')->nullable();
            $table->foreign('ktp_id')->references('id')->on('images');
            $table->foreignId('selfie_id')->nullable();
            $table->foreign('selfie_id')->references('id')->on('images');
            $table->timestamp('ktp_selfie_verified_at')->nullable();
            $table->foreignId('tabungan_id')->nullable();
            $table->foreign('tabungan_id')->references('id')->on('images');
            $table->timestamp('tabungan_verified_at')->nullable();
            $table->foreignId('profile_id')->nullable();
            $table->foreign('profile_id')->references('id')->on('images');
            $table->foreignId('status_id');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->rememberToken();
            $table->softDeletes();
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
