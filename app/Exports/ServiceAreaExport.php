<?php

namespace App\Exports;

use App\Models\ServiceArea;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceAreaExport implements FromCollection , WithHeadings
{

    protected $service_areas;

    public function __construct($service_areas)
    {
        $this->service_areas = $service_areas;
    }


    public function headings(): array
    {
        return [
            'Area Id',
        ];
    }

    public function collection()
    {
        return $this->service_areas;
    }
}
