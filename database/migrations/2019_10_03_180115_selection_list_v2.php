<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SelectionListV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selection_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->nullable();
            $table->string('student_name')->nullable();
            $table->string('catholic_or_non_catholic')->nullable();
            $table->string('calit_or_non_dalit')->nullable();
            $table->string('maths')->nullable();
            $table->string('physics')->nullable();
            $table->string('chemistry')->nullable();
            $table->string('cut_off')->nullable();
            $table->string('choice_1')->nullable();
            $table->string('choice_2')->nullable();
            $table->string('religion')->nullable();
            $table->string('community')->nullable();
            $table->string('caste')->nullable();
            $table->string('board')->nullable();
            $table->string('year_of_passing')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_designation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_designation')->nullable();
            $table->string('monthly_income')->nullable();
            $table->string('father_mobile_no')->nullable();
            $table->string('mother_mobile_no')->nullable();
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
        //
    }
}
