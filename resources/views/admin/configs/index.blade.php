@extends('layouts.admin')

@section('title', 'Configurations')
@section('page-title', 'App Configurations')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    @foreach($configs as $config)
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200 {{ $config->config_type == 'config_a' ? 'bg-gradient-to-r from-blue-50 to-blue-100' : 'bg-gradient-to-r from-purple-50 to-purple-100' }}">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold {{ $config->config_type == 'config_a' ? 'text-blue-900' : 'text-purple-900' }}">
                        {{ $config->config_type == 'config_a' ? 'Config A' : 'Config B' }}
                    </h3>
                    <p class="text-sm {{ $config->config_type == 'config_a' ? 'text-blue-700' : 'text-purple-700' }} mt-1">
                        {{ $config->config_type == 'config_a' ? 'SIM Owner Details App' : 'Room Search App' }}
                    </p>
                </div>
                <span class="px-3 py-1 {{ $config->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }} rounded-full text-sm font-medium">
                    {{ $config->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>

        <div class="p-6 space-y-4">
            <div>
                <p class="text-sm text-gray-500">App Title</p>
                <p class="text-lg font-medium text-gray-900">{{ $config->app_title }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Search Placeholder</p>
                <p class="text-gray-700">{{ $config->search_placeholder }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Version</p>
                <p class="text-gray-700">{{ $config->version }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Countries</p>
                <p class="text-gray-700">
                    @if($config->config_type == 'config_a')
                        <span class="text-green-600 font-medium">Whitelisted countries only</span>
                    @else
                        <span class="text-blue-600 font-medium">All non-whitelisted countries</span>
                    @endif
                </p>
            </div>

            <div class="pt-4">
                <a href="{{ route('admin.configs.edit', $config) }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition">
                    <i class="fas fa-edit mr-2"></i>Edit Configuration
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($configs->isEmpty())
<div class="bg-white rounded-lg shadow p-12 text-center">
    <i class="fas fa-cog text-gray-300 text-6xl mb-4"></i>
    <p class="text-gray-500">No configurations found</p>
</div>
@endif
@endsection
