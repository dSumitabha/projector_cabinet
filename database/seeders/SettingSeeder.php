<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['key' => 'logo', 'value' => 'uploads/pc.png'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/yourpage'],
            ['key' => 'youtube', 'value' => 'https://youtube.com/yourchannel'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
