<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\selection_list1__dalith_catholic;

class selectionlist1DCExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return selection_list1__dalith_catholic::all();
    }
}
