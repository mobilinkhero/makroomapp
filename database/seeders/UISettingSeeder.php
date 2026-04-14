<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UISetting;

class UISettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Config A Settings
            [
                'key' => 'config_a_show_contact_admin_button',
                'config_type' => 'config_a',
                'setting_type' => 'boolean',
                'value' => 'true',
                'label' => 'Show "Contact Admin" Button',
                'description' => 'Display contact admin button when no results found'
            ],
            [
                'key' => 'config_a_contact_admin_email',
                'config_type' => 'config_a',
                'setting_type' => 'text',
                'value' => 'admin@simowner.com',
                'label' => 'Contact Admin Email',
                'description' => 'Email address for contact admin button'
            ],
            [
                'key' => 'config_a_no_results_message',
                'config_type' => 'config_a',
                'setting_type' => 'text',
                'value' => 'No SIM owner details found. Please contact admin for assistance.',
                'label' => 'No Results Message',
                'description' => 'Message shown when no search results'
            ],
            [
                'key' => 'config_a_enable_advanced_search',
                'config_type' => 'config_a',
                'setting_type' => 'boolean',
                'value' => 'true',
                'label' => 'Enable Advanced Search',
                'description' => 'Allow users to use advanced search filters'
            ],

            // Config B Settings
            [
                'key' => 'config_b_show_contact_admin_button',
                'config_type' => 'config_b',
                'setting_type' => 'boolean',
                'value' => 'false',
                'label' => 'Show "Contact Admin" Button',
                'description' => 'Display contact admin button when no results found'
            ],
            [
                'key' => 'config_b_contact_admin_email',
                'config_type' => 'config_b',
                'setting_type' => 'text',
                'value' => 'support@roomfinder.com',
                'label' => 'Contact Admin Email',
                'description' => 'Email address for contact admin button'
            ],
            [
                'key' => 'config_b_no_results_message',
                'config_type' => 'config_b',
                'setting_type' => 'text',
                'value' => 'No rooms found matching your search. Try different keywords.',
                'label' => 'No Results Message',
                'description' => 'Message shown when no search results'
            ],
            [
                'key' => 'config_b_enable_favorites',
                'config_type' => 'config_b',
                'setting_type' => 'boolean',
                'value' => 'true',
                'label' => 'Enable Favorites',
                'description' => 'Allow users to save favorite rooms'
            ],
        ];

        foreach ($settings as $setting) {
            UISetting::create($setting);
        }
    }
}
