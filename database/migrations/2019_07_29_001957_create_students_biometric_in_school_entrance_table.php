<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsBiometricInSchoolEntranceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_biometric_in_school_entrance', function (Blueprint $table) {
            $table->tinyIncrements('entrance_biometric_number');
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
        Schema::dropIfExists('students_biometric_in_school_entrance');
    }
}
