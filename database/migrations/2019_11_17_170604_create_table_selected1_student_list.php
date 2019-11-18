<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSelected1StudentList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_selected1_student_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id')->nullable();
            $table->string('student_name')->nullable();
            $table->string('register_no')->nullable();
            $table->string('department')->nullable();
            $table->string('catholic_or_non_catholic')->nullable();
            $table->string('calit_or_non_dalit')->nullable();
            $table->string('poor_or_not_poor')->nullable();
            $table->string('cut_off')->nullable();
            $table->string('mode_choice')->nullable();
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
        Schema::dropIfExists('table_selected1_student_list');
    }
}
