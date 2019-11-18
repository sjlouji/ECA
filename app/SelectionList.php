<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectionList extends Model
{
        protected $fillable = [
            'application_no',
            'year_of_addmission',
            'student_name',
            'catholic_or_non_catholic',
            'calit_or_non_dalit',
            'maths',
            'chemistry',
            'physics',
            'cut_off',
            'choice_1',
            'choice_2',
            'religion',
            'poor_or_not_poor',
            'community',
            'caste',
            'board',
            'year_of_passing',
            'father_name',
            'father_designation',
            'mother_name',
            'mother_designation',
            'monthly_income',
            'father_mobile_no',
            'mother_mobile_no',
      ];
}
