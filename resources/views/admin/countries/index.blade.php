@extends('layouts.admin')

@section('title', 'Countries')
@section('page-title', 'Country Management')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Manage Country Whitelist</h3>
                <p class="text-sm text-gray-600 mt-1">Select countries for Config A (SIM Owner) or Config B (Room Search)</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                    <i class="fas fa-check-circle mr-1"></i>Config A (Whitelisted)
                </span>
                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-medium">
                    <i class="fas fa-times-circle mr-1"></i>Config B (Not Whitelisted)
                </span>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
            <button onclick="selectAll()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition text-sm">
                <i class="fas fa-check-square mr-2"></i>Select All
            </button>
            <button onclick="deselectAll()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition text-sm">
                <i class="fas fa-square mr-2"></i>Deselect All
            </button>
            <div class="border-l border-gray-300 h-8"></div>
            <button onclick="bulkAction('whitelist')" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition text-sm">
                <i class="fas fa-plus mr-2"></i>Add Selected to Config A
            </button>
            <button onclick="bulkAction('unwhitelist')" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition text-sm">
                <i class="fas fa-minus mr-2"></i>Move Selected to Config B
            </button>
            <span id="selected-count" class="text-sm text-gray-600 ml-4"></span>
        </div>
    </div>

    <form id="bulk-form" action="{{ route('admin.countries.bulk-update') }}" method="POST">
        @csrf
        <input type="hidden" name="action" id="bulk-action">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-6">
            @foreach($countries as $country)
            <label class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition hover:shadow-md {{ $country->is_whitelisted ? 'border-blue-300 bg-blue-50' : 'border-purple-300 bg-purple-50' }}">
                <input type="checkbox" name="country_ids[]" value="{{ $country->id }}" class="country-checkbox w-5 h-5 text-indigo-600 rounded focus:ring-indigo-500" onchange="updateSelectedCount()">
                <div class="ml-3 flex-1">
                    <div class="flex items-center justify-between">
                        <span class="font-medium text-gray-900">{{ $country->name }}</span>
                        <span class="text-xs text-gray-500 ml-2">{{ $country->code }}</span>
                    </div>
                    <div class="mt-1">
                        @if($country->is_whitelisted)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-check-circle mr-1"></i>Config A
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                <i class="fas fa-circle mr-1"></i>Config B
                            </span>
                        @endif
                    </div>
                </div>
            </label>
            @endforeach
        </div>
    </form>

    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between text-sm text-gray-600">
            <div>
                <span class="font-medium">{{ $countries->where('is_whitelisted', true)->count() }}</span> countries in Config A (Whitelisted)
                <span class="mx-2">•</span>
                <span class="font-medium">{{ $countries->where('is_whitelisted', false)->count() }}</span> countries in Config B
            </div>
            <div>
                Total: <span class="font-medium">{{ $countries->count() }}</span> countries
            </div>
        </div>
    </div>
</div>
function selectAll() {
    document.querySelectorAll('.country-checkbox').forEach(cb => cb.checked = true);
    updateSelectedCount();
}

function deselectAll() {
    document.querySelectorAll('.country-checkbox').forEach(cb => cb.checked = false);
    updateSelectedCount();
}

function updateSelectedCount() {
    const count = document.querySelectorAll('.country-checkbox:checked').length;
    document.getElementById('selected-count').textContent = count > 0 ? `${count} selected` : '';
}

function bulkAction(action) {
    const checked = document.querySelectorAll('.country-checkbox:checked').length;
    if (checked === 0) {
        alert('Please select at least one country');
        return;
    }
    
    const actionText = action === 'whitelist' ? 'add to Config A (Whitelisted)' : 'move to Config B (Not Whitelisted)';
    if (confirm(`Are you sure you want to ${actionText} ${checked} countries?`)) {
        document.getElementById('bulk-action').value = action;
        document.getElementById('bulk-form').submit();
    }
}
</script>
@endsection
