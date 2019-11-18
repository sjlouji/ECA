<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class selection_list1__roman_catholic extends Model
{
    protected $fillable = [
        'id',
        'student_id',
        'student_name',
        'register_no',
        'department',
        'cut_off',
        'mode_choice',
  ];
}
