<?php

namespace App\Imports;

use App\Models\ProductAssociated;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
class ProductAssociatedImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    /**
     * Define the model for each row.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $row = array_change_key_case($row, CASE_LOWER);
        return new ProductAssociated([
            'parent_product_id' => $row['simulation_id'],
            'projector_make' => $row['projector_make'],
            'projector_model' => $row['projector_model'],
            'screen_size' => $row['screen_size'],
            'ceiling_height' => $row['ceiling_height'],
            'center_channel_height' => $row['center_channel_height'],
            'simulated_center_channel' => $row['simulated_center_channel'],
            'center_channel_slot_from_bottom' => $row['center_channel_slot_from_bottom'],
            'projector_platform_slot_from_bottom' => $row['projector_slot_from_bottom'],
            'center_channel_tilt_slot' => $row['center_channel_tilt_slot'],
            'center_channel_tilt_rod_lenth' => $row['center_channel_tilt_rod_length'],
            'center_channel_l_clamp_position' => $row['center_channel_l_clamp_position'],
            'distance_of_cabinet_from_screen' => $row['distance_of_cabinet_from_screen'],
            'floor_raising_slot_from_bottom' => $row['floor_raising_slot_from_bottom'],
            'distance_of_projector_from_screen' => $row['distance_of_projector_from_screen'],
            'viewing_angle_sitting' => $row['viewing_angle_sitting'],
            'viewing_angle_reclining' => $row['viewing_angle_reclining'],
            'hearing_angle' => $row['hearing_angle'],
            'hearing_angle_reclining' => $row['hearing_angle_reclining'],
            'distance_of_top_section_of_screen_from_ceiling' => $row['distance_of_top_section_of_screen_from_ceiling'],
            'distance_of_bottom_section_of_the_screen_from_floor' => $row['distance_of_bottom_section_of_the_screen_from_floor'],
            'distance_of_floor_raising_screen_from_wall' => $row['distance_of_cabinet_from_wall'],
            'max_center_channel_height' => $row['max_center_channel_height'],
            'max_center_channel_length' => $row['max_center_channel_length'],
            'max_allowed_center_channel_depth' => $row['max_allowed_center_channel_depth'],
            'center_channel_flag' => $row['center_channel_independent_flag'],
        ]);
    }

    /**
     * Define the validation rules for each row.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'simulation_id' => 'required',

            'projector_make' => 'required|string',
            'projector_model' => 'required|string',
            'projector_platform_slot_from_bottom' => 'nullable',
            'center_channel_slot_from_bottom' => 'nullable',
            'floor_raising_slot_from_bottom' => 'nullable',
            'screen_size' => 'required|numeric',
            'ceiling_height' => 'required|numeric',
            'distance_of_cabinet_from_screen' => 'nullable',
            'distance_of_projector_from_screen' => 'nullable',
            'distance_of_top_section_of_screen_from_ceiling' => 'nullable',
            'distance_of_bottom_section_of_the_screen_from_floor' => 'nullable',
            'viewing_angle_sitting' => 'nullable',
            'viewing_angle_reclining' => 'nullable',
            'hearing_angle' => 'nullable',
            'max_center_channel_height' => 'nullable|numeric',
            'max_center_channel_length' => 'nullable|numeric',
            'max_allowed_center_channel_depth' => 'nullable|numeric',
        ];
    }

    /**
     * Define custom validation messages.
     *
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'simulation_id.required' => 'Parent Product ID is required.',



            'projector_make.required' => 'Projector Make is required.',
            'projector_make.string' => 'Projector Make must be a string.',
            'projector_model.required' => 'Projector Model is required.',
            'projector_model.string' => 'Projector Model must be a string.',
            'projector_platform_slot_from_bottom.integer' => 'Projector Platform Slot From Bottom must be an integer.',
            'center_channel_slot_from_bottom.integer' => 'Center Channel Slot From Bottom must be an integer.',
            'floor_raising_slot_from_bottom.integer' => 'Floor Raising Slot From Bottom must be an integer.',
            'screen_size.required' => 'Screensize is required.',
            'screen_size.numeric' => 'Screensize must be an integer.',
            'ceiling_height.required' => 'Ceiling Height is required.',
            'ceiling_height.numeric' => 'Ceiling Height must be an integer.',
            'distance_of_cabinet_from_screen.string' => 'Distance of Cabinet From Screen must be a string.',
            'distance_of_projector_from_screen.integer' => 'Distance of Projector From Screen must be an integer.',
            'distance_of_top_section_of_screen_from_ceiling.string' => 'Distance of Top Section Of Screen From Ceiling must be a string.',
            'distance_of_bottom_section_of_the_screen_from_floor.integer' => 'Distance of Bottom Section Of The Screen From Floor must be integer.',
            'viewing_angle_sitting.string' => 'Viewing Angle Sitting must be a string.',
            'viewing_angle_reclining.string' => 'Viewing Angle Reclining must be a string.',
            'hearing_angle.string' => 'Hearing Angle must be a string.',
            'max_center_channel_length.numeric' => 'Max Center Channel Length must be an integer.',
            'max_allowed_center_channel_depth.numeric' => 'Max Center Channel Depth must be an integer.',
            'max_center_channel_height.numeric' => 'Max Center Channel Height must be an integer.',
        ];
    }
}
