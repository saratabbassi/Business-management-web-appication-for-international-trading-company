<?php

namespace App\Exports;

use App\products;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return products::select('name',);
    }
    public function headings(): array
    {
        return [
            'Invoice Number',
            'User',
            'Date',
        ];
    }
}
