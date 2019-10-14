<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cseselection extends Model
{
    protected $fillable = [
        'application_no',
        'student_name',
        'religion',
        'catholic_or_non_catholic',
        'calit_or_non_dalit',
        'cut_off',
  ];
}
