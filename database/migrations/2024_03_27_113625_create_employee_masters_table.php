<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_masters', function (Blueprint $table) {
           
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('employee_name');
            $table->string('employee_code');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->string('address');

            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');

            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');

            $table->string('zip');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_masters');
    }
};
