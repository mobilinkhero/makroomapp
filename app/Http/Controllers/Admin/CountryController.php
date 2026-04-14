<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name')->get();
        return view('admin.countries.index', compact('countries'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'is_whitelisted' => 'required|boolean',
        ]);

        $country->update([
            'is_whitelisted' => $request->is_whitelisted,
        ]);

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country updated successfully');
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'country_ids' => 'required|array',
            'country_ids.*' => 'exists:countries,id',
            'action' => 'required|in:whitelist,unwhitelist',
        ]);

        $isWhitelisted = $request->action === 'whitelist';
        
        Country::whereIn('id', $request->country_ids)->update([
            'is_whitelisted' => $isWhitelisted,
        ]);

        $count = count($request->country_ids);
        $action = $isWhitelisted ? 'added to' : 'removed from';
        
        return redirect()->route('admin.countries.index')
            ->with('success', "{$count} countries {$action} whitelist successfully");
    }
}
