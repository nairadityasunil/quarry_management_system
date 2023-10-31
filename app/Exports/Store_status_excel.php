<?php

namespace App\Exports;

use App\Models\Store_status;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class Store_status_excel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $store_status = Store_status::all();
        $store_status = Store_status::select('id' , 'item_name' , 'unit' , 'quantity')->get();
        return $store_status;
    }

    public function headings():array
    {
        return
        [
            'Sr no.',
            'Item Name',
            'Unit',
            'Quantity',
        ];
    }
    
    public function registerEvents():array
    {
        return
        [
            AfterSheet::class => function(AfterSheet $event)
            {
                $cell_range = 'A1:D1';
                $event->sheet->getDelegate()->getStyle($cell_range)->getFont()->setSize(14);
            }
        ];
    }
}
