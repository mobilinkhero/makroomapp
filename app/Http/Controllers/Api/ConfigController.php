<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\AppConfig;
use App\Models\UISetting;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index(Request $request)
    {
        // Get country code from header or default to US
        $countryCode = $request->header('X-Country-Code', 'US');
        
        // Check if country is whitelisted
        $country = Country::where('code', $countryCode)->first();
        
        $configType = ($country && $country->is_whitelisted) 
                      ? 'config_a' 
                      : 'config_b';
        
        $config = AppConfig::where('config_type', $configType)
                           ->where('is_active', true)
                           ->first();
        
        // Get UI settings for this config
        $uiSettings = UISetting::where('config_type', $configType)->get();
        $uiSettingsArray = [];
        foreach ($uiSettings as $setting) {
            $key = str_replace($configType . '_', '', $setting->key);
            $value = $setting->value;
            
            // Convert boolean strings to actual booleans
            if ($setting->setting_type === 'boolean') {
                $value = $value === 'true';
            }
            
            $uiSettingsArray[$key] = $value;
        }
        
        // If no config found, return default config
        if (!$config) {
            return response()->json([
                'version' => '1.0.0',
                'layout' => ['type' => 'vertical', 'padding' => 16],
                'components' => [
                    [
                        'id' => 'search-bar',
                        'type' => 'search',
                        'properties' => [
                            'placeholder' => 'Search...',
                            'hint' => 'Enter your search query'
                        ]
                    ]
                ],
                'searchConfig' => [
                    'endpoint' => '/api/search',
                    'fields' => [
                        ['name' => 'query', 'type' => 'text', 'required' => true]
                    ],
                    'resultDisplay' => [
                        'layout' => 'list',
                        'itemLayout' => 'card'
                    ]
                ],
                'featureFlags' => [
                    'enableAdvancedSearch' => true,
                    'enableImageDisplay' => true
                ],
                'uiSettings' => $uiSettingsArray
            ]);
        }
        
        return response()->json([
            'version' => $config->version,
            'layout' => ['type' => 'vertical', 'padding' => 16],
            'components' => json_decode($config->components ?? '[]'),
            'searchConfig' => [
                'endpoint' => '/api/search',
                'fields' => [
                    ['name' => 'query', 'type' => 'text', 'required' => true]
                ],
                'resultDisplay' => [
                    'layout' => 'list',
                    'itemLayout' => 'card'
                ]
            ],
            'featureFlags' => json_decode($config->feature_flags ?? '{}'),
            'uiSettings' => $uiSettingsArray
        ]);
    }
}
