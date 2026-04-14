@extends('layouts.admin')

@section('title', 'Records')
@section('page-title', 'Record Management')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.records.index') }}" class="px-4 py-2 {{ !request('config_type') ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-lg">
            All Records
        </a>
        <a href="{{ route('admin.records.index', ['config_type' => 'config_a']) }}" class="px-4 py-2 {{ request('config_type') == 'config_a' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-lg">
            Config A (SIM)
        </a>
        <a href="{{ route('admin.records.index', ['config_type' => 'config_b']) }}" class="px-4 py-2 {{ request('config_type') == 'config_b' ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-lg">
            Config B (Room)
        </a>
    </div>
    <a href="{{ route('admin.records.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition">
        <i class="fas fa-plus mr-2"></i>Add New Record
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Config</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($records as $record)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $record->title }}</div>
                        <div class="text-sm text-gray-500">{{ Str::limit($record->description, 50) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $record->config_type == 'config_a' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                            {{ $record->config_type == 'config_a' ? 'Config A' : 'Config B' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($record->is_active)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $record->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-3">
                        <a href="{{ route('admin.records.edit', $record) }}" class="text-indigo-600 hover:text-indigo-900">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.records.destroy', $record) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-4"></i>
                        <p>No records found</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-gray-200">
        {{ $records->links() }}
    </div>
</div>
@endsection
