<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Create a Product model instance for each row in the Excel file.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Convert all keys to lowercase (to match your database column names).
        $row = array_change_key_case($row, CASE_LOWER);

        return new Product([
            'gs1' => $row['gs1'] ?? null,
            'gs1_type' => $row['gs1_type'] ?? null,
            'parent_product_id' => $row['simulation_id'],
            'packaging_product_id' => $row['packaging_product_id']?? null,
            'layout_id' => $row['layout_id']?? null,
            'fusion_id' => $row['fusion_id']?? null,
            'render_id' => $row['render_id']?? null,
            'product_center_channel_placement' => $row['product_center_channel_placement']?? null,
            'product_id' => $row['product_id'],
            'product_frontend_name' => $row['product_frontend_name'] ?? null,
            'product_frontend_description' => $row['product_frontend_description'] ?? null,
            'product_name' => $row['product_name'],
            'profile' => $row['profile'] ?? null,
            'size' => $row['size'] ?? null,
            'has_doors' => $row['has_doors'] ?? null,
            'color' => $row['color'] ?? null,
            'diy' => $row['diy'] ?? null,
            'off_wall' => $row['off_wall'] ?? null,
            'floor_raising_screen' => $row['floor_raising_screen'] ?? null,
            'product_type' => $row['product_type'],
            'length_of_cabinet' => $row['length_of_cabinet'] ?? null,
            'height_of_cabinet' => $row['height_of_cabinet'] ?? null,
            'depth_of_cabinet' => $row['depth_of_cabinet'] ?? null,
            'depth_of_middle_section' => $row['depth_of_middle_section'] ?? null,
            'depth_of_side_sections' => $row['depth_of_side_sections'] ?? null,
            'center_channel_chamber_length' => $row['center_channel_chamber_length'] ?? null,
            'center_channel_chamber_depth' => $row['center_channel_chamber_depth'] ?? null,
            'center_channel_chamber_height' => $row['center_channel_chamber_height'] ?? null,
            'profit_percentage' => $row['profit_percentage'] ?? null, // Optional
            'profit_margin' => $row['profit_margin'] ?? null, // Optional
            'selling_price' => $row['selling_price'] ?? null,
            'compatable_with_projectors' => $row['compatable_with_projectors'] ?? null,
            'compatable_with_center_channels' => $row['compatable_with_center_channels'] ?? null,
            'center_channel_placement' => $row['center_channel_placement'] ?? null,
            'variable_height_projector_platform' => $row['variable_height_projector_platform'] ?? null,
            'variable_height_center_channel_platform' => $row['variable_height_center_channel_platform'] ?? null,
            'variable_depth_center_channel_platform' => $row['variable_depth_center_channel_platform'] ?? null,
            'angling_mechanism_for_center_channel' => $row['angling_mechanism_for_center_channel'] ?? null,
            'enclosed_ust_projector' => $row['enclosed_ust_projector'] ?? null,
            'enclosed_center_channel' => $row['enclosed_center_channel'] ?? null,
            'open_back_design' => $row['open_back_design'] ?? null,
            'silent_fan_for_flushing_heat_from_avr' => $row['silent_fan_for_flushing_heat_from_avr'] ?? null,
            'adjustable_height_legs' => $row['adjustable_height_legs'] ?? null,
            'remote_friendly' => $row['remote_friendly'] ?? null,

            'is_floor_raising_screen_embedded_within_cabinet' => $row['is_floor_raising_screen_embedded_within_cabinet'] ?? null,
            'material' => $row['material'] ?? null,
            'installation_required' => $row['installation_required'] ?? null
        ]);
    }

    /**
     * Define validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'gs1'                  => 'nullable',
            'gs1_type'             => 'nullable',
            'simulation_id'     => [
                'required_if:product_type,Child Product' // Required if product_type is 'Child Product'
                ,
            ],
            'product_type' => [
                'required',
                function ($attribute, $value, $fail) {
                    $validTypes = ['child product', 'parent product']; // Acceptable values for product_type
                    if (!in_array(strtolower($value), $validTypes)) {
                        // Validation fails if product_type is not 'Child Product' or 'Parent Product' (case-insensitive)
                        $fail('The product type must be "Child Product" or "Parent Product" (case-insensitive).');
                    }
                },
            ],
            'product_id'           => [
                'required',

                Rule::unique('products', 'product_id'), // Ensure uniqueness
            ],
            'product_frontend_name' => 'required',
            'product_name'         => 'required',
            'profile'              => 'nullable',
            'size'                 => 'nullable',
            'has_doors'            => 'nullable',
            'color'                => 'nullable',
            'diy'                  => 'nullable',

            'length_of_cabinet'     => 'nullable',
            'height_of_cabinet'     => 'nullable',
            'depth_of_cabinet'      => 'nullable',


            'profit_percentage'    => 'nullable',
            'compatable_with_projectors' => 'nullable',
            'compatable_with_center_channels' => 'nullable',
            'center_channel_placement' => 'nullable',
            'variable_height_projector_platform' => 'nullable',
            'variable_height_center_channel_platform' => 'nullable',
            'variable_depth_center_channel_platform' => 'nullable',
            'angling_mechanism_for_center_channel' => 'nullable',
            'enclosed_ust_projector' => 'nullable',
            'enclosed_center_channel' => 'nullable',
            'open_back_design' => 'nullable',
            'silent_fan_for_flushing_heat_from_avr' => 'nullable',
            'adjustable_height_legs' => 'nullable',
            'remote_friendly' => 'nullable',
            'off_wall_cabinet' => 'nullable',
            'is_floor_raising_screen_embedded_within_cabinet' => 'nullable',
            'material' => 'nullable',
            'installation_required' => 'nullable',
        ];
    }
}
