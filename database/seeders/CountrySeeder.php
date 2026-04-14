<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            // Whitelisted countries (Config A - SIM Owner Details)
            ['name' => 'United States', 'code' => 'US', 'is_whitelisted' => true],
            ['name' => 'United Kingdom', 'code' => 'GB', 'is_whitelisted' => true],
            ['name' => 'Canada', 'code' => 'CA', 'is_whitelisted' => true],
            ['name' => 'Australia', 'code' => 'AU', 'is_whitelisted' => true],
            ['name' => 'Germany', 'code' => 'DE', 'is_whitelisted' => true],
            
            // Non-whitelisted countries (Config B - Room Search)
            ['name' => 'Pakistan', 'code' => 'PK', 'is_whitelisted' => false],
            ['name' => 'India', 'code' => 'IN', 'is_whitelisted' => false],
            ['name' => 'Bangladesh', 'code' => 'BD', 'is_whitelisted' => false],
            ['name' => 'China', 'code' => 'CN', 'is_whitelisted' => false],
            ['name' => 'Japan', 'code' => 'JP', 'is_whitelisted' => false],
            ['name' => 'Brazil', 'code' => 'BR', 'is_whitelisted' => false],
            ['name' => 'Mexico', 'code' => 'MX', 'is_whitelisted' => false],
            ['name' => 'France', 'code' => 'FR', 'is_whitelisted' => false],
            ['name' => 'Italy', 'code' => 'IT', 'is_whitelisted' => false],
            ['name' => 'Spain', 'code' => 'ES', 'is_whitelisted' => false],
            ['name' => 'Netherlands', 'code' => 'NL', 'is_whitelisted' => false],
            ['name' => 'Sweden', 'code' => 'SE', 'is_whitelisted' => false],
            ['name' => 'Norway', 'code' => 'NO', 'is_whitelisted' => false],
            ['name' => 'Denmark', 'code' => 'DK', 'is_whitelisted' => false],
            ['name' => 'Finland', 'code' => 'FI', 'is_whitelisted' => false],
            ['name' => 'Poland', 'code' => 'PL', 'is_whitelisted' => false],
            ['name' => 'Turkey', 'code' => 'TR', 'is_whitelisted' => false],
            ['name' => 'Saudi Arabia', 'code' => 'SA', 'is_whitelisted' => false],
            ['name' => 'UAE', 'code' => 'AE', 'is_whitelisted' => false],
            ['name' => 'South Africa', 'code' => 'ZA', 'is_whitelisted' => false],
            ['name' => 'Nigeria', 'code' => 'NG', 'is_whitelisted' => false],
            ['name' => 'Egypt', 'code' => 'EG', 'is_whitelisted' => false],
            ['name' => 'Kenya', 'code' => 'KE', 'is_whitelisted' => false],
            ['name' => 'South Korea', 'code' => 'KR', 'is_whitelisted' => false],
            ['name' => 'Singapore', 'code' => 'SG', 'is_whitelisted' => false],
            ['name' => 'Malaysia', 'code' => 'MY', 'is_whitelisted' => false],
            ['name' => 'Thailand', 'code' => 'TH', 'is_whitelisted' => false],
            ['name' => 'Vietnam', 'code' => 'VN', 'is_whitelisted' => false],
            ['name' => 'Philippines', 'code' => 'PH', 'is_whitelisted' => false],
            ['name' => 'Indonesia', 'code' => 'ID', 'is_whitelisted' => false],
            ['name' => 'New Zealand', 'code' => 'NZ', 'is_whitelisted' => false],
            ['name' => 'Argentina', 'code' => 'AR', 'is_whitelisted' => false],
            ['name' => 'Chile', 'code' => 'CL', 'is_whitelisted' => false],
            ['name' => 'Colombia', 'code' => 'CO', 'is_whitelisted' => false],
            ['name' => 'Peru', 'code' => 'PE', 'is_whitelisted' => false],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
