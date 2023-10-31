<?php

namespace App\Exports;

use App\Models\Sales_in;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;


class Sales_in_excel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        $sales_details = Sales_in::all();
        return $sales_details;
    }

    public function headings():array
    {
        return
        [
            'Sr no.',
            'Lease',
            'Selling Company',
            'Vehicle No.',
            'Driver',
            'Customer Name',
            'Item',
            'Date & Time',
            'Tare Wt',
            'Created At',

        ];
    }
    
    public function registerEvents():array
    {
        return
        [
            AfterSheet::class => function(AfterSheet $event)
            {
                $cell_range = 'A1:L1';
                $event->sheet->getDelegate()->getStyle($cell_range)->getFont()->setSize(14);
            }
        ];
    }
}
