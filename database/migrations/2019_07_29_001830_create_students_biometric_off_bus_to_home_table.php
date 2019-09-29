<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsBiometricOffBusToHomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_biometric_off_bus_to_home', function (Blueprint $table) {
            $table->tinyIncrements('off_bus_to_home_');
            $table->string('student_no');
            $table->foreign('student_no')->references('student_no')->on('students_biometrics');
            $table->date('date');
            $table->time('time');
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
        Schema::dropIfExists('students_biometric_on_bus_to_home');
    }
}
