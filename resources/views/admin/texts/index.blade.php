@extends('layouts.admin')

@section('title', 'App Texts')
@section('page-title', 'App Text Management')

@section('content')
<div class="mb-6 flex items-center space-x-4">
    <a href="{{ route('admin.texts.index') }}" class="px-4 py-2 {{ !request('config_type') ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-lg">
        All Texts
    </a>
    <a href="{{ route('admin.texts.index', ['config_type' => 'config_a']) }}" class="px-4 py-2 {{ request('config_type') == 'config_a' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-lg">
        Config A
    </a>
    <a href="{{ route('admin.texts.index', ['config_type' => 'config_b']) }}" class="px-4 py-2 {{ request('config_type') == 'config_b' ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-lg">
        Config B
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Key</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Config</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($texts as $text)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $text->key }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ Str::limit($text->value, 50) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $text->config_type == 'config_a' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                            {{ $text->config_type == 'config_a' ? 'Config A' : 'Config B' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">{{ Str::limit($text->description, 40) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('admin.texts.edit', $text) }}" class="text-indigo-600 hover:text-indigo-900">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-4"></i>
                        <p>No texts found</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-gray-200">
        {{ $texts->links() }}
    </div>
</div>
@endsection
