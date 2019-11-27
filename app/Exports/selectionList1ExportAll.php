<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Log;
use App\selection_list1__roman_catholic;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use App\Exports;

class selectionList1ExportAll implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $depName;
    use Exportable;

    public function __construct($depName) {
           $this->depName = $depName;
           Log::info('in'.$this->depName);
    }
 

    // public function collection()
    // {   
    //     return selection_list1__roman_catholic::where('department','=','IT')->get();
    // }
        public function sheets(): array
        {
            $sheets = DB::table('departments')->select('department_name')->get();
            Log::info(count($sheets));
            $she = [];
            if($this->depName == 'selection_list1__dalith_catholic'){
                foreach($sheets as $sheet) { 
                    Log::info($sheet->department_name);
                    $she[] = new selectionList1Query($sheet->department_name,'selection_list1__dalith_catholic');
                }
            }
            elseif($this->depName == 'selection_list1__open_quota'){
                foreach($sheets as $sheet) { 
                    Log::info($sheet->department_name);
                    $she[] = new selectionList1Query($sheet->department_name,'selection_list1__open_quota');
                }
                Log::info("working");
            }
            elseif($this->depName == 'selection_list1__roman_catholic'){
                foreach($sheets as $sheet) { 
                    Log::info($sheet->department_name);
                    $she[] = new selectionList1Query($sheet->department_name,'selection_list1__roman_catholic');
                }
            }
            elseif($this->depName == 'selection_list1__rural_and__poor'){
                foreach($sheets as $sheet) { 
                    Log::info($sheet->department_name);
                    $she[] = new selectionList1Query($sheet->department_name,'selection_list1__rural_and__poor');
                }
            }
            return $she;
        }

  
}
