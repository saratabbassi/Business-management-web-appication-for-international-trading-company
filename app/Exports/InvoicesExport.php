<?php

namespace App\Exports;

use App\Invoices;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;

class InvoicesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Invoices::select('invoice_no','invoice_date','devise','customer_name','poids_brut','poids_net','packages','livraison','payment_details','shipping','total_due')->get();
    }
    public function headings(): array
    {
        return [
            'Invoice Number',
            'Invoice Date',
            'Devise',
            'Customer',
            'Gross Weight',
            'Net Weight',
            'Number Of Packages',
            'Delivery',
            'Payment Details',
            'Shipping Cost',
            'Total Invoice',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event){
                $event->sheet->getStyle('A1:K1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }
}
