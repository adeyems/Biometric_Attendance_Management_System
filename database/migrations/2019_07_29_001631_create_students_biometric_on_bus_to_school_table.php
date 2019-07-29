<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsBiometricOnBusToSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_biometric_on_bus_to_school', function (Blueprint $table) {
            $table->tinyIncrements('on_bus_to_school_number');
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
        Schema::dropIfExists('students_biometric_on_bus_to_school');
    }
}
