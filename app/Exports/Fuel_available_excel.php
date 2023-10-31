<?php

namespace App\Exports;

use App\Models\Fuel_available;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class Fuel_available_excel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $fuel_available = Fuel_available::all();
        $fuel_available = Fuel_available::select('id' , 'fuel_type' , 'quantity')->get();
        return $fuel_available;
    }

    public function headings():array
    {
        return
        [
            'Sr no.',
            'Fuel Type',
            'Quantity',
        ];
    }
    
    public function registerEvents():array
    {
        return
        [
            AfterSheet::class => function(AfterSheet $event)
            {
                $cell_range = 'A1:C1';
                $event->sheet->getDelegate()->getStyle($cell_range)->getFont()->setSize(14);
            }
        ];
    }
}
