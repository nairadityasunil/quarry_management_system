<?php

namespace App\Exports;

use App\Models\Sales_out;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;


class Sales_excel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        $sales_from = session()->get('sales_from');
        $sales_to = session()->get('sales_to');
        $sales_details = Sales_out::whereBetween('created_at', [$sales_from.' 00:00:00', $sales_to.' 23:59:59'])->get();
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
