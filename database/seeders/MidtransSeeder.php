<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Midtrans;

class MidtransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Midtrans::create([
            "name"=>"Midtrans",
            "client_key"=>"",
            "secret_key"=>""
        ]);
    }
}
