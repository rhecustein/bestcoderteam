<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MidtransPayment;

class MidtransPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MidtransPayment::create([
            "name"=>"Midtrans",
            "client_key"=>"",
            "secret_key"=>""
        ]);
    }
}
