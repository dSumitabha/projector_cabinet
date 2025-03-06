<?php

namespace Database\Seeders;

use App\Models\SalesRate;
use Illuminate\Database\Seeder;

class SalesRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalesRate::create([
            'rate' => 9.75
        ]);
    }
}
