<?php

namespace App\Exports;

use App\Models\Purchase_out;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class Purchase_excel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $purchase_from = session()->get('purchase_from');
        $purchase_to = session()->get('purchase_to');
        $purchase_details = Purchase_out::whereBetween('created_at', [$purchase_from.' 00:00:00', $purchase_to.' 23:59:59'])->get();
        return $purchase_details;
    }

    public function headings():array
    {
        return
        [
            'Sr no.',
            'Lease',
            'Company',
            'Supplier',
            'Date & Time',
            'Item',
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
