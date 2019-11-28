<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class selectionList2Input extends Model
{
    protected $fillable = [
        'id',
        'student_id',
        'year_of_selection',
        'student_name',
        'register_no',
        'department',
        'cut_off',
        'paid_stauts',
  ];
}
