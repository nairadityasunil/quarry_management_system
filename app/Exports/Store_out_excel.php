<?php

namespace App\Exports;

use App\Models\Store_out;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class Store_out_excel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $store_out_from = session()->get('store_out_from');
        $store_out_to = session()->get('store_out_to');
        $store_out_details = Store_out::whereBetween('created_at', [$store_out_from.' 00:00:00', $store_out_to.' 23:59:59'])->get();
        return $store_out_details;
    }

    public function headings():array
    {
        return
        [
            'Sr no.',
            'Item Name',
            'Unit',
            'Quantity',
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
