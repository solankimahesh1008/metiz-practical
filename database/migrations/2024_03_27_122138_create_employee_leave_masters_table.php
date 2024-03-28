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
        Schema::create('employee_leave_masters', function (Blueprint $table) {
          
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('leaveType');
            $table->string('employee_code');
            $table->date('fromdate');
            $table->date('todate');
            $table->integer('numberofDays');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_leave_masters');
    }
};
