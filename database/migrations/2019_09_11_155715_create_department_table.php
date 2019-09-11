<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('department_name');
            $table->string('total_seats');
            $table->string('total_seats_management_quota');
            $table->string('total_seats_open_catholic');
            $table->string('total_seats_Roman_catholic');
            $table->string('total_seats_Dalit_catholic');
            $table->string('total_seats_Rural_poor_students');
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
        Schema::dropIfExists('department');
    }
}
