<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('img_id')->nullable();
            $table->foreign('img_id')->references('id')->on('images');
            $table->foreignId('status_id');
            $table->integer('fee_admin');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->string('name');
            $table->string('code');
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
        Schema::dropIfExists('paymentcategories');
    }
}
