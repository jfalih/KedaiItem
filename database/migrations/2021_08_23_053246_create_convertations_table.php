<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvertationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convertations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_id');
            $table->foreign('from_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('to_id');
            $table->foreign('to_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('convertations');
    }
}
