<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Record;

class QuickStartSeeder extends Seeder
{
    public function run(): void
    {
        // Sample records for Config B (Room Search)
        $roomRecords = [
            [
                'config_type' => 'config_b',
                'title' => 'Modern Office Space',
                'description' => 'Spacious office with natural lighting and modern amenities',
                'data' => json_encode([
                    'capacity' => ['type' => 'number', 'value' => 50],
                    'rating' => ['type' => 'number', 'value' => 4.5],
                    'date' => ['type' => 'date', 'value' => '2026-04-14']
                ]),
                'is_active' => true
            ],
            [
                'config_type' => 'config_b',
                'title' => 'Conference Room A',
                'description' => 'Large conference room with video conferencing equipment',
                'data' => json_encode([
                    'capacity' => ['type' => 'number', 'value' => 20],
                    'rating' => ['type' => 'number', 'value' => 4.8],
                    'date' => ['type' => 'date', 'value' => '2026-04-13']
                ]),
                'is_active' => true
            ],
            [
                'config_type' => 'config_b',
                'title' => 'Creative Studio',
                'description' => 'Open space perfect for creative teams and brainstorming',
                'data' => json_encode([
                    'capacity' => ['type' => 'number', 'value' => 15],
                    'rating' => ['type' => 'number', 'value' => 4.7],
                    'date' => ['type' => 'date', 'value' => '2026-04-12']
                ]),
                'is_active' => true
            ],
        ];

        foreach ($roomRecords as $record) {
            Record::create($record);
        }
    }
}
