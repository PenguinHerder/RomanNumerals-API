<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRomanNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roman_numbers', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('roman', 32);
            $table->integer('request_count');
            $table->timestamps();
        });

        Schema::create('conversion_requests', function (Blueprint $table) {
            $table->integer('roman_number_id');
            $table->dateTime('request_date');

            $table->foreign('roman_number_id')->references('id')->on('roman_numbers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversion_requests');
        Schema::dropIfExists('roman_numbers');
    }
}
