<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaulfValueAsNullInSelectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('selection_lists', function (Blueprint $table) {
            $table->string('application_no')->nullable()->change();
            $table->string('student_name')->nullable()->change();
            $table->string('catholic_or_non_catholic')->nullable()->change();
            $table->string('calit_or_non_dalit')->nullable()->change();
            $table->string('maths')->nullable()->change();
            $table->string('chemistry')->nullable()->change();
            $table->string('cut_off')->nullable()->change();
            $table->string('choice_1')->nullable()->change();
            $table->string('choice_2')->nullable()->change();
            $table->string('religion')->nullable()->change();
            $table->string('community')->nullable()->change();
            $table->string('caste')->nullable()->change();
            $table->string('board')->nullable()->change();
            $table->string('year_of_passing')->nullable()->change();
            $table->string('father_name')->nullable()->change();
            $table->string('father_designation')->nullable()->change();
            $table->string('mother_name')->nullable()->change();
            $table->string('mother_designation')->nullable()->change();
            $table->string('monthly_income')->nullable()->change();
            $table->string('father_mobile_no')->nullable()->change();
            $table->string('mother_mobile_no')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('selection', function (Blueprint $table) {
            //
        });
    }
}
