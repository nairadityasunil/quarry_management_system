<?php

namespace App\Exports;

use App\Models\Fuel_in;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class Fuel_in_excel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $fuel_in_from = session()->get('fuel_in_from');
        $fuel_in_to = session()->get('fuel_in_to');
        $fuel_in_details = Fuel_in::whereBetween('created_at', [$fuel_in_from.' 00:00:00', $fuel_in_to.' 23:59:59'])->get();
        return $fuel_in_details;
    }

    public function headings():array
    {
        return
        [
            'Sr no.',
            'Bill No.',
            'Seller',
            'Fuel Type',
            'Quantity',
            'Rate',
            'Total Amount',
            'Vehicle No.',
            'Driver',
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
                $cell_range = 'A1:K1';
                $event->sheet->getDelegate()->getStyle($cell_range)->getFont()->setSize(14);
            }
        ];
    }
}
