<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class selection_list1__dalith_catholic extends Model
{
    protected $fillable = [
        'id',
        'student_id',
        'year_of_selection',
        'student_name',
        'register_no',
        'department',
        'cut_off',
        'mode_choice',
        'paid_stauts',
  ];
}
