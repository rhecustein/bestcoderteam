<?php

namespace App\Imports;

use App\Models\ServiceArea;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithStartRow;
use Str;
use Auth;

class ServiceAreaImport implements ToModel , WithStartRow
{

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $auth_user = Auth::guard('web')->user();

        return new ServiceArea([
            'city_id' => $row[0],
            'provider_id' => $auth_user->id
        ]);
    }
}
