<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Log;
use App\selection_list1__dalith_catholic;
use App\selection_list1__open_quota;
use App\selection_list1__roman_catholic;
use App\selection_list1__rural_and__poor;
use Maatwebsite\Excel\Concerns\Exportable;


class selectionList1Query implements FromQuery
{
    use Exportable;

    protected $depName;
    protected $quota;
    public function __construct($depName,$quota) {
        $this->depName = $depName;
        $this->quota = $quota;
    }

    public function query()
    {
        if($this->quota == 'selection_list1__dalith_catholic'){
             $val =  selection_list1__dalith_catholic::query()->where('department',$this->depName);
        }
        elseif($this->quota == 'selection_list1__open_quota'){
            $val = selection_list1__open_quota::query()->where('department',$this->depName);
        }
        elseif($this->quota == 'selection_list1__roman_catholic'){
            $val = selection_list1__roman_catholic::query()->where('department',$this->depName);
        }
        elseif($this->quota == 'selection_list1__rural_and__poor'){
            $val = selection_list1__rural_and__poor::query()->where('department',$this->depName);
        }
        return $val;
    }

 
}
