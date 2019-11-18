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
            'poor_or_not_poor' => $row[12],
            'community'  =>  $row[13],
            'caste'  =>  $row[14],
            'board'  =>  $row[15],
            'year_of_passing'  =>  $row[16],
            'father_name'  =>  $row[17],
            'father_designation'  =>  $row[18],
            'mother_name'  =>  $row[19],
            'mother_designation'  =>  $row[20],
            'monthly_income'  =>  $row[21],
            'father_mobile_no'  =>  $row[22],
            'mother_mobile_no'  =>  $row[23],
        ]);
        return new batch([
            'year'     =>  $row[1],
        ]);
    }
}
