<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppText;

class AppTextSeeder extends Seeder
{
    public function run(): void
    {
        $texts = [
            // Config A - SIM Owner Details App
            [
                'key' => 'config_a_welcome_message',
                'config_type' => 'config_a',
                'value' => 'Welcome to SIM Owner Details',
                'description' => 'Welcome message shown on app launch'
            ],
            [
                'key' => 'config_a_search_hint',
                'config_type' => 'config_a',
                'value' => 'Enter phone number to find owner details',
                'description' => 'Hint text for search functionality'
            ],
            [
                'key' => 'config_a_no_results',
                'config_type' => 'config_a',
                'value' => 'No SIM owner details found',
                'description' => 'Message when no search results'
            ],
            [
                'key' => 'config_a_error_message',
                'config_type' => 'config_a',
                'value' => 'Unable to fetch details. Please try again.',
                'description' => 'Generic error message'
            ],

            // Config B - Room Search App
            [
                'key' => 'config_b_welcome_message',
                'config_type' => 'config_b',
                'value' => 'Find Your Perfect Room',
                'description' => 'Welcome message shown on app launch'
            ],
            [
                'key' => 'config_b_search_hint',
                'config_type' => 'config_b',
                'value' => 'Search by location, capacity, or amenities',
                'description' => 'Hint text for search functionality'
            ],
            [
                'key' => 'config_b_no_results',
                'config_type' => 'config_b',
                'value' => 'No rooms found matching your search',
                'description' => 'Message when no search results'
            ],
            [
                'key' => 'config_b_error_message',
                'config_type' => 'config_b',
                'value' => 'Something went wrong. Please try again.',
                'description' => 'Generic error message'
            ],
        ];

        foreach ($texts as $text) {
            AppText::create($text);
        }
    }
}
