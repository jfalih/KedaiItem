<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logo_id')->nullable();
            $table->foreign('logo_id')->references('id')->on('images');
            $table->foreignId('favicon_id')->nullable();
            $table->foreign('favicon_id')->references('id')->on('images');
            $table->string('name');
            $table->integer('harga');
            $table->enum('maintenance', [0,1]);
            $table->string('title');
            $table->text('description');
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
        Schema::dropIfExists('settings');
    }
}
