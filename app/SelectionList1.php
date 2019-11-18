<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectionList1 extends Model
{
    protected $fillable = [
        'id',
        'student_id',
        'student_name',
        'department',
        'catholic_or_non_catholic',
        'calit_or_non_dalit',
        'cut_off',
        'mode_choice',
  ];
}
