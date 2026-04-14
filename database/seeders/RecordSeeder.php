<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Record;

class RecordSeeder extends Seeder
{
    public function run(): void
    {
        // Config A Records - SIM Owner Details
        $configARecords = [
            [
                'config_type' => 'config_a',
                'title' => '+1-555-0123',
                'description' => 'John Smith - Verified Owner',
                'is_active' => true,
                'data' => json_encode([
                    'owner_name' => ['type' => 'text', 'value' => 'John Smith'],
                    'carrier' => ['type' => 'text', 'value' => 'AT&T'],
                    'registration_date' => ['type' => 'text', 'value' => '2020-05-15'],
                    'status' => ['type' => 'text', 'value' => 'Active'],
                ])
            ],
            [
                'config_type' => 'config_a',
                'title' => '+1-555-0456',
                'description' => 'Sarah Johnson - Verified Owner',
                'is_active' => true,
                'data' => json_encode([
                    'owner_name' => ['type' => 'text', 'value' => 'Sarah Johnson'],
                    'carrier' => ['type' => 'text', 'value' => 'Verizon'],
                    'registration_date' => ['type' => 'text', 'value' => '2019-08-22'],
                    'status' => ['type' => 'text', 'value' => 'Active'],
                ])
            ],
            [
                'config_type' => 'config_a',
                'title' => '+1-555-0789',
                'description' => 'Michael Brown - Verified Owner',
                'is_active' => true,
                'data' => json_encode([
                    'owner_name' => ['type' => 'text', 'value' => 'Michael Brown'],
                    'carrier' => ['type' => 'text', 'value' => 'T-Mobile'],
                    'registration_date' => ['type' => 'text', 'value' => '2021-03-10'],
                    'status' => ['type' => 'text', 'value' => 'Active'],
                ])
            ],
        ];

        // Config B Records - Room Search
        $configBRecords = [
            [
                'config_type' => 'config_b',
                'title' => 'Modern Office Space',
                'description' => 'Spacious office with natural lighting and modern amenities',
                'is_active' => true,
                'data' => json_encode([
                    'capacity' => ['type' => 'number', 'value' => 50],
                    'rating' => ['type' => 'number', 'value' => 4.5],
                    'location' => ['type' => 'text', 'value' => 'Downtown'],
                    'price' => ['type' => 'text', 'value' => '$2,500/month'],
                ])
            ],
            [
                'config_type' => 'config_b',
                'title' => 'Conference Room A',
                'description' => 'Professional meeting space with video conferencing',
                'is_active' => true,
                'data' => json_encode([
                    'capacity' => ['type' => 'number', 'value' => 20],
                    'rating' => ['type' => 'number', 'value' => 4.8],
                    'location' => ['type' => 'text', 'value' => 'Business District'],
                    'price' => ['type' => 'text', 'value' => '$150/hour'],
                ])
            ],
            [
                'config_type' => 'config_b',
                'title' => 'Creative Studio',
                'description' => 'Bright and inspiring workspace for creative teams',
                'is_active' => true,
                'data' => json_encode([
                    'capacity' => ['type' => 'number', 'value' => 15],
                    'rating' => ['type' => 'number', 'value' => 4.7],
                    'location' => ['type' => 'text', 'value' => 'Arts Quarter'],
                    'price' => ['type' => 'text', 'value' => '$1,800/month'],
                ])
            ],
            [
                'config_type' => 'config_b',
                'title' => 'Executive Boardroom',
                'description' => 'Luxury boardroom with premium furnishings',
                'is_active' => true,
                'data' => json_encode([
                    'capacity' => ['type' => 'number', 'value' => 12],
                    'rating' => ['type' => 'number', 'value' => 4.9],
                    'location' => ['type' => 'text', 'value' => 'Financial District'],
                    'price' => ['type' => 'text', 'value' => '$200/hour'],
                ])
            ],
            [
                'config_type' => 'config_b',
                'title' => 'Coworking Space',
                'description' => 'Flexible workspace with hot desks and private offices',
                'is_active' => true,
                'data' => json_encode([
                    'capacity' => ['type' => 'number', 'value' => 100],
                    'rating' => ['type' => 'number', 'value' => 4.6],
                    'location' => ['type' => 'text', 'value' => 'Tech Hub'],
                    'price' => ['type' => 'text', 'value' => '$300/month'],
                ])
            ],
            [
                'config_type' => 'config_b',
                'title' => 'Training Room',
                'description' => 'Equipped with projector and whiteboard for workshops',
                'is_active' => true,
                'data' => json_encode([
                    'capacity' => ['type' => 'number', 'value' => 30],
                    'rating' => ['type' => 'number', 'value' => 4.4],
                    'location' => ['type' => 'text', 'value' => 'Education Center'],
                    'price' => ['type' => 'text', 'value' => '$100/hour'],
                ])
            ],
        ];

        foreach ($configARecords as $record) {
            Record::create($record);
        }

        foreach ($configBRecords as $record) {
            Record::create($record);
        }
    }
}
