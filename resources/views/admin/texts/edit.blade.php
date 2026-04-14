@extends('layouts.admin')

@section('title', 'Edit Text')
@section('page-title', 'Edit App Text')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.texts.update', $text) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Key</label>
                <input type="text" value="{{ $text->key }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" disabled>
                <p class="mt-1 text-sm text-gray-500">Key cannot be changed</p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Configuration</label>
                <input type="text" value="{{ $text->config_type == 'config_a' ? 'Config A (SIM Owner)' : 'Config B (Room Search)' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" disabled>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Value</label>
                <textarea name="value" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>{{ old('value', $text->value) }}</textarea>
                @error('value')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <input type="text" value="{{ $text->description }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" disabled>
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition">
                    <i class="fas fa-save mr-2"></i>Update Text
                </button>
                <a href="{{ route('admin.texts.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
