@extends('layouts.admin')

@section('title', 'UI Settings')
@section('page-title', 'UI Settings')

@section('content')
<div class="mb-6 flex items-center space-x-4">
    <a href="{{ route('admin.ui-settings.index', ['config_type' => 'config_a']) }}" class="px-6 py-3 {{ $configType == 'config_a' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-lg font-medium transition hover:shadow-md">
        <i class="fas fa-mobile-alt mr-2"></i>Config A (SIM Owner)
    </a>
    <a href="{{ route('admin.ui-settings.index', ['config_type' => 'config_b']) }}" class="px-6 py-3 {{ $configType == 'config_b' ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-lg font-medium transition hover:shadow-md">
        <i class="fas fa-door-open mr-2"></i>Config B (Room Search)
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200 {{ $configType == 'config_a' ? 'bg-gradient-to-r from-blue-50 to-blue-100' : 'bg-gradient-to-r from-purple-50 to-purple-100' }}">
        <h3 class="text-xl font-bold {{ $configType == 'config_a' ? 'text-blue-900' : 'text-purple-900' }}">
            {{ $configType == 'config_a' ? 'Config A - SIM Owner Details App' : 'Config B - Room Search App' }}
        </h3>
        <p class="text-sm {{ $configType == 'config_a' ? 'text-blue-700' : 'text-purple-700' }} mt-1">
            Configure UI behavior and features for this app configuration
        </p>
    </div>

    <form action="{{ route('admin.ui-settings.update') }}" method="POST" class="p-6">
        @csrf
        
        <div class="space-y-6">
            @foreach($settings as $setting)
            <div class="border-b border-gray-200 pb-6 last:border-0">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-900 mb-1">
                            {{ $setting->label }}
                        </label>
                        @if($setting->description)
                            <p class="text-sm text-gray-500 mb-3">{{ $setting->description }}</p>
                        @endif

                        <input type="hidden" name="settings[{{ $loop->index }}][id]" value="{{ $setting->id }}">

                        @if($setting->setting_type === 'boolean')
                            <div class="flex items-center space-x-3">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="settings[{{ $loop->index }}][value]" value="true" {{ $setting->value === 'true' ? 'checked' : '' }} class="sr-only peer">
                                    <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                                <span class="text-sm text-gray-700">
                                    <span class="peer-checked:hidden">Disabled</span>
                                    <span class="hidden peer-checked:inline">Enabled</span>
                                </span>
                            </div>
                            <input type="hidden" name="settings[{{ $loop->index }}][value]" value="false">
                        @elseif($setting->setting_type === 'text')
                            <input type="text" name="settings[{{ $loop->index }}][value]" value="{{ $setting->value }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @elseif($setting->setting_type === 'number')
                            <input type="number" name="settings[{{ $loop->index }}][value]" value="{{ $setting->value }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @elseif($setting->setting_type === 'json')
                            <textarea name="settings[{{ $loop->index }}][value]" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-sm">{{ $setting->value }}</textarea>
                        @endif
                    </div>

                    <div class="ml-4">
                        @if($setting->setting_type === 'boolean')
                            @if($setting->value === 'true')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>Enabled
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-times-circle mr-1"></i>Disabled
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-600">
                <i class="fas fa-info-circle mr-2"></i>
                Changes will be reflected in the mobile app immediately
            </div>
            <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition font-medium">
                <i class="fas fa-save mr-2"></i>Save Settings
            </button>
        </div>
    </form>
</div>

@if($settings->isEmpty())
<div class="bg-white rounded-lg shadow p-12 text-center">
    <i class="fas fa-cog text-gray-300 text-6xl mb-4"></i>
    <p class="text-gray-500">No UI settings found for this configuration</p>
</div>
@endif
@endsection
