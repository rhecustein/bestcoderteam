<?php

namespace App\Exports;

use App\Models\City;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class CityExport implements FromCollection, WithHeadings
{

    protected $cities;

    public function __construct($cities)
    {
        $this->cities = $cities;
    }

    public function headings(): array
    {
        return [
            'Area Id',
            'Area Name',
        ];
    }

    public function collection()
    {
        return $this->cities;
    }
}
