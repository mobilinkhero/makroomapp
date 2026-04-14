@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Countries -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Countries</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_countries'] }}</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <i class="fas fa-globe text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Whitelisted Countries -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Whitelisted</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['whitelisted_countries'] }}</p>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Records -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Records</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_records'] }}</p>
            </div>
            <div class="bg-purple-100 rounded-full p-3">
                <i class="fas fa-database text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Active Records -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Active Records</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['active_records'] }}</p>
            </div>
            <div class="bg-indigo-100 rounded-full p-3">
                <i class="fas fa-check text-indigo-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Config Stats -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Records by Configuration</h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                    <span class="text-gray-700">Config A (SIM Owner)</span>
                </div>
                <span class="font-semibold text-gray-800">{{ $stats['config_a_records'] }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                    <span class="text-gray-700">Config B (Room Search)</span>
                </div>
                <span class="font-semibold text-gray-800">{{ $stats['config_b_records'] }}</span>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
        <div class="space-y-3">
            <a href="{{ route('admin.records.create') }}" class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white text-center py-3 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>Add New Record
            </a>
            <a href="{{ route('admin.countries.index') }}" class="block w-full bg-gray-600 hover:bg-gray-700 text-white text-center py-3 rounded-lg transition">
                <i class="fas fa-globe mr-2"></i>Manage Countries
            </a>
            <a href="{{ route('admin.configs.index') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center py-3 rounded-lg transition">
                <i class="fas fa-cog mr-2"></i>Edit Configurations
            </a>
        </div>
    </div>
</div>
@endsection
