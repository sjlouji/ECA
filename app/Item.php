<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $fillable = ['title','description'];
    // protected $fillable = [
    //     'application_no',
    //     'student_name',
    //     'catholic_or_non_catholic',
    //     'calit_or_non_dalit',
    //     'maths',
    //     'chemistry',
    //     'cut_off',
    //     'choice_1',
    //     'choice_2',
    //     'religion',
    //     'community',
    //     'caste',
    //     'board',
    //     'year_of_passing',
    //     'father_name',
    //     'father_designation',
    //     'mother_name',
    //     'mother_designation',
    //     'monthly_income',
    //     'father_mobile_no',
    //     'mother_mobile_no',
    //   ];
}
