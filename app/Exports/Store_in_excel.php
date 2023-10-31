<?php

namespace App\Exports;

use App\Models\Store_in;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class Store_in_excel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $store_in_from = session()->get('store_in_from');
        $store_in_to = session()->get('store_in_to');
        $store_in_details = Store_in::whereBetween('created_at', [$store_in_from.' 00:00:00', $store_in_to.' 23:59:59'])->get();
        return $store_in_details;
    }

    public function headings():array
    {
        return
        [
            'Sr no.',
            'Item Name',
            'Seller',
            'Unit',
            'Quantity',
            'Price Per Unit',
            'Total Value',
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
                $cell_range = 'A1:I1';
                $event->sheet->getDelegate()->getStyle($cell_range)->getFont()->setSize(14);
            }
        ];
    }
}
