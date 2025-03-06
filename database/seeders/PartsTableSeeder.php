<?php

namespace Database\Seeders;

use App\Models\Part;
use Illuminate\Database\Seeder;

class PartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parts = [
            [
                'part_id' => 'FUSIONDESIGN',
                'part_name' => 'Design Service Fusion 360',
                'part_type' => 'Service',
                'rate' => 25,
                'unit_cost' => null,
                'source' => null,
                'units_available' => 52,
            ],
            [
                'part_id' => 'PLYWOOD34',
                'part_name' => 'Ply wood 3/4th sheet. Black Vineer on top of plywood.',
                'part_type' => 'Physical',
                'rate' => null,
                'unit_cost' => 70,
                'source' => null,
                'units_available' => 0,
            ],
            [
                'part_id' => 'PLYWOOD14',
                'part_name' => 'Ply wood 1/4th sheet. Black board.',
                'part_type' => 'Physical',
                'rate' => null,
                'unit_cost' => 50,
                'source' => null,
                'units_available' => 0,
            ],
            [
                'part_id' => 'CNCCUT1SIDE',
                'part_name' => 'CNC cut for Cabinet One side cut only',
                'part_type' => 'Service',
                'rate' => 70,
                'unit_cost' => null,
                'source' => null,
                'units_available' => 0,
            ],
            [
                'part_id' => 'CNCCUT2SIDE',
                'part_name' => 'CNC cut for Cabinet two side cut.',
                'part_type' => 'Service',
                'rate' => 70,
                'unit_cost' => null,
                'source' => null,
                'units_available' => 0,
            ],
            [
                'part_id' => 'EDGEBANDING SER',
                'part_name' => 'Edge Banding',
                'part_type' => 'Service',
                'rate' => 1,
                'unit_cost' => null,
                'source' => null,
                'units_available' => 0,
            ],
            [
                'part_id' => 'EDGEBANDING',
                'part_name' => 'Edge Banding matching material',
                'part_type' => 'Physical',
                'rate' => null,
                'unit_cost' => 80,
                'source' => null,
                'units_available' => 0,
            ],
        ];

        foreach ($parts as $part) {
            Part::create($part);
        }
    }

}
