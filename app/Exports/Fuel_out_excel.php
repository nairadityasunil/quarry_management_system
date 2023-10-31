<?php

namespace App\Exports;

use App\Models\Fuel_out;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class Fuel_out_excel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $fuel_out_from = session()->get('fuel_out_from');
        $fuel_out_to = session()->get('fuel_out_to');
        $fuel_out_details = Fuel_out::whereBetween('created_at', [$fuel_out_from.' 00:00:00', $fuel_out_to.' 23:59:59'])->get();
        return $fuel_out_details;
    }

    public function headings():array
    {
        return
        [
            'Sr no.',
            'Fuel Type',
            'Quantity',
            'Vehicle No.',
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
                $cell_range = 'A1:F1';
                $event->sheet->getDelegate()->getStyle($cell_range)->getFont()->setSize(14);
            }
        ];
    }
}
