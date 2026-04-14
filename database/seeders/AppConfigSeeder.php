<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppConfig;

class AppConfigSeeder extends Seeder
{
    public function run(): void
    {
        // Config A - SIM Owner Details App (for whitelisted countries)
        AppConfig::create([
            'config_type' => 'config_a',
            'version' => '1.0.0',
            'app_title' => 'SIM Owner Details',
            'search_placeholder' => 'Enter phone number or SIM details...',
            'is_active' => true,
            'components' => json_encode([
                [
                    'id' => 'search-bar',
                    'type' => 'search',
                    'properties' => [
                        'placeholder' => 'Enter phone number or SIM details...',
                        'hint' => 'Search for SIM owner information'
                    ]
                ]
            ]),
            'feature_flags' => json_encode([
                'enable_advanced_search' => true,
                'enable_export' => true,
                'enable_notifications' => true
            ])
        ]);

        // Config B - Room Search App (for non-whitelisted countries)
        AppConfig::create([
            'config_type' => 'config_b',
            'version' => '1.0.0',
            'app_title' => 'Room Finder',
            'search_placeholder' => 'Search for rooms...',
            'is_active' => true,
            'components' => json_encode([
                [
                    'id' => 'search-bar',
                    'type' => 'search',
                    'properties' => [
                        'placeholder' => 'Search for rooms...',
                        'hint' => 'Enter your search query'
                    ]
                ]
            ]),
            'feature_flags' => json_encode([
                'enable_advanced_search' => true,
                'enable_favorites' => true,
                'enable_map_view' => false
            ])
        ]);
    }
}
