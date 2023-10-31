<?php

namespace App\Exports;

use App\Models\Sales_out;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;


class Sales_full_excel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        $sales_details = Sales_out::all();
        return $sales_details;
    }

    public function headings():array
    {
        return
        [
            'Sr no.',
            'Lease',
            'Selling Company',
            'Customer Name',
            'Item',
            'Date & Time',
            'Vehicle No.',
            'Driver',
            'Tare Wt',
            'Gross Wt',
            'Net Wt',
            'Created At',
            'Updated At'
        ];
    }
    
    public function registerEvents():array
    {
        return
        [
            AfterSheet::class => function(AfterSheet $event)
            {
                $cell_range = 'A1:M1';
                $event->sheet->getDelegate()->getStyle($cell_range)->getFont()->setSize(14);
            }
        ];
    }
}
