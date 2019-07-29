<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsBiometricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_biometrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_no')->unique();
            $table->string('student_name');
            $table->string('student_surname');
            $table->mediumText('student_address');
            $table->string('student_class');
            $table->string('student_class_teacher_number');
            $table->string('student_fingerprint');
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
        Schema::dropIfExists('students_biometrics');
    }
}
