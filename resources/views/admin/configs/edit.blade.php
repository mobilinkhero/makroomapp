@extends('layouts.admin')

@section('title', 'Edit Configuration')
@section('page-title', 'Edit Configuration')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="mb-6 p-4 {{ $config->config_type == 'config_a' ? 'bg-blue-50 border-l-4 border-blue-500' : 'bg-purple-50 border-l-4 border-purple-500' }} rounded">
            <h3 class="font-semibold {{ $config->config_type == 'config_a' ? 'text-blue-900' : 'text-purple-900' }}">
                {{ $config->config_type == 'config_a' ? 'Config A - SIM Owner Details App' : 'Config B - Room Search App' }}
            </h3>
            <p class="text-sm {{ $config->config_type == 'config_a' ? 'text-blue-700' : 'text-purple-700' }} mt-1">
                {{ $config->config_type == 'config_a' ? 'Shown to whitelisted countries' : 'Shown to all other countries' }}
            </p>
        </div>

        <form action="{{ route('admin.configs.update', $config) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">App Title</label>
                <input type="text" name="app_title" value="{{ old('app_title', $config->app_title) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                @error('app_title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Search Placeholder</label>
                <input type="text" name="search_placeholder" value="{{ old('search_placeholder', $config->search_placeholder) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                @error('search_placeholder')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Components (JSON)</label>
                <textarea name="components" rows="8" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-sm">{{ old('components', $config->components) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Define UI components in JSON format</p>
                @error('components')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Feature Flags (JSON)</label>
                <textarea name="feature_flags" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-sm">{{ old('feature_flags', $config->feature_flags) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Enable/disable features in JSON format</p>
                @error('feature_flags')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition">
                    <i class="fas fa-save mr-2"></i>Update Configuration
                </button>
                <a href="{{ route('admin.configs.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
