<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no');
            $table->string('student_name');
            $table->string('catholic_or_non_catholic');
            $table->string('calit_or_non_dalit');
            $table->string('maths');
            $table->string('chemistry');
            $table->string('cut_off');
            $table->string('choice_1');
            $table->string('choice_2');
            $table->string('religion');
            $table->string('community');
            $table->string('caste');
            $table->string('board');
            $table->string('year_of_passing');
            $table->string('father_name');
            $table->string('father_designation');
            $table->string('mother_name');
            $table->string('mother_designation');
            $table->string('monthly_income');
            $table->string('father_mobile_no');
            $table->string('mother_mobile_no');
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
        Schema::dropIfExists('admission');
    }
}
