<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_parts')->insert([
            [
                'product_id' => 'FWDRTAAV08120',
                'part_id' => 'FUSIONDESIGN',
                'part_name' => 'Design Service Fusion 360',
                'part_type' => 'Service',
                'rate' => 25,
                'total_hours_units' => 4,
                'unit_cost' => null,
                'percentage_used' => null,
                'total' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 'FWDRTAAV08120',
                'part_id' => 'PLYWOOD34',
                'part_name' => 'Ply wood 3/4th sheet. Black Vineer on top of plywood.',
                'part_type' => 'Physical',
                'rate' => null,
                'total_hours_units' => 3,
                'unit_cost' => 70,
                'percentage_used' => 100,
                'total' => 210,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 'FWDRTAAV08120',
                'part_id' => 'PLYWOOD14',
                'part_name' => 'Ply wood 1/4th sheet. Black board.',
                'part_type' => 'Physical',
                'rate' => null,
                'total_hours_units' => 1,
                'unit_cost' => 50,
                'percentage_used' => 50,
                'total' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 'FWDRTAAV08120',
                'part_id' => 'CNCCUT1SIDE',
                'part_name' => 'CNC cut for Cabinet One side cut only',
                'part_type' => 'Service',
                'rate' => 70,
                'total_hours_units' => 1,
                'unit_cost' => 70,
                'percentage_used' => null,
                'total' => 70,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 'FWDRTAAV08120',
                'part_id' => 'CNCCUT2SIDE',
                'part_name' => 'CNC cut for Cabinet two side cut.',
                'part_type' => 'Service',
                'rate' => 70,
                'total_hours_units' => 2,
                'unit_cost' => 70,
                'percentage_used' => null,
                'total' => 140,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 'FWDRTAAV08120',
                'part_id' => 'EDGEBANDING SER',
                'part_name' => 'Edge Banding',
                'part_type' => 'Service',
                'rate' => 1,
                'total_hours_units' => null,
                'unit_cost' => 60,
                'percentage_used' => null,
                'total' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 'FWDRTAAV08120',
                'part_id' => 'EDGEBANDING',
                'part_name' => 'Edge Banding matching material',
                'part_type' => 'Physical',
                'rate' => null,
                'total_hours_units' => 1,
                'unit_cost' => 80,
                'percentage_used' => 50,
                'total' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
