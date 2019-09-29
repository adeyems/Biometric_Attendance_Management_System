<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_parents', function (Blueprint $table) {
            $table->tinyIncrements('parent_no');
            $table->string('parent_name');
            $table->string('parent_surname');
            $table->string('student_no');
            $table->foreign('student_no')->references('student_no')->on('students_biometrics');
            $table->mediumText('home_address');
            $table->string('username');
            $table->string('password');
            $table->string('mobile_no');
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
        Schema::dropIfExists('students_parents');
    }
}
