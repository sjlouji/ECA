<?php

namespace App\Imports;

use App\SelectionList;
use Maatwebsite\Excel\Concerns\ToModel;

class SelectionListModel implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SelectionList([
            'application_no'      =>  $row[0],
            'year_of_addmission'     =>  $row[1],
            'student_name'  =>  $row[2],
            'catholic_or_non_catholic'  =>  $row[3],
            'calit_or_non_dalit'  =>  $row[4],
            'maths'  =>  $row[5],
            'physics' => $row[6],
            'chemistry'  =>  $row[7],
            'cut_off'  =>  $row[8],
            'choice_1'  =>  $row[9],
            'choice_2'  =>  $row[10],
            'religion'  =>  $row[11],
            'community'  =>  $row[12],
            'caste'  =>  $row[13],
            'board'  =>  $row[14],
            'year_of_passing'  =>  $row[15],
            'father_name'  =>  $row[16],
            'father_designation'  =>  $row[17],
            'mother_name'  =>  $row[18],
            'mother_designation'  =>  $row[19],
            'monthly_income'  =>  $row[20],
            'father_mobile_no'  =>  $row[21],
            'mother_mobile_no'  =>  $row[22],
        ]);
        return new batch([
            'year'     =>  $row[1],
        ]);
    }
}
