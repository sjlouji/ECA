<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMechdepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_mechdepartment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->nullable();
            $table->string('student_name')->nullable();
            $table->string('catholic_or_non_catholic')->nullable();
            $table->string('calit_or_non_dalit')->nullable();
            $table->string('cut_off')->nullable();
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
        Schema::dropIfExists('table_mechdepartment');
    }
}
