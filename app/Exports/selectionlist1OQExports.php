<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;


class selectionlist1OQExports implements FromQuery, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $depName;

    public function __construct($depName) {
           $this->depName = $depName;
    }

    public function query()
    {
           return selection_list1__roman_catholic::query()->where('department',$this->depName);
    }
}
