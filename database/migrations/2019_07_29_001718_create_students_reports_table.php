<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_reports', function (Blueprint $table) {
            $table->bigIncrements('report_no');
             $table->string('student_no');
             $table->foreign('student_no')->references('student_no')->on('students_biometrics');
             $table->unsignedTinyInteger('parent_no');
            $table->foreign('parent_no')->references('parent_no')->on('students_parents');
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
        Schema::dropIfExists('students_reports');
    }
}
