<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\AppConfig;
use App\Models\UISetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ConfigController extends Controller
{
    public function index(Request $request)
    {
        // Get country code from IP address
        $countryCode = $this->getCountryFromIP($request);
        
        Log::info('Country detected', ['country_code' => $countryCode, 'ip' => $request->ip()]);
        
        // Check if country is whitelisted
        $country = Country::where('code', $countryCode)->first();
        
        $configType = ($country && $country->is_whitelisted) 
                      ? 'config_a' 
                      : 'config_b';
        
        Log::info('Config type determined', ['config_type' => $configType, 'is_whitelisted' => $country ? $country->is_whitelisted : false]);
        
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
                'uiSettings' => $uiSettingsArray,
                'detectedCountry' => $countryCode,
                'configType' => $configType
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
            'uiSettings' => $uiSettingsArray,
            'detectedCountry' => $countryCode,
            'configType' => $configType
        ]);
    }
    
    private function getCountryFromIP(Request $request)
    {
        // First check if country code is provided in header (for testing)
        if ($request->hasHeader('X-Country-Code')) {
            return strtoupper($request->header('X-Country-Code'));
        }
        
        $ip = $request->ip();
        
        // For local/private IPs, default to US for testing
        if ($ip === '127.0.0.1' || $ip === '::1' || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
            Log::info('Local IP detected, defaulting to US', ['ip' => $ip]);
            return 'US';
        }
        
        try {
            // Use ip-api.com (free, no API key required, 45 requests/minute)
            $response = Http::timeout(3)->get("http://ip-api.com/json/{$ip}");
            
            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['countryCode'])) {
                    Log::info('Country detected from IP', ['ip' => $ip, 'country' => $data['countryCode']]);
                    return strtoupper($data['countryCode']);
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to detect country from IP', ['ip' => $ip, 'error' => $e->getMessage()]);
        }
        
        // Default to US if detection fails
        Log::info('Country detection failed, defaulting to US', ['ip' => $ip]);
        return 'US';
    }
}
