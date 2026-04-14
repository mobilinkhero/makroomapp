<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index(Request $request)
    {
        $query = Record::query();

        if ($request->has('config_type')) {
            $query->where('config_type', $request->config_type);
        }

        $records = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.records.index', compact('records'));
    }

    public function create()
    {
        return view('admin.records.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'config_type' => 'required|in:config_a,config_b',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'data' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        Record::create($request->all());

        return redirect()->route('admin.records.index')
            ->with('success', 'Record created successfully');
    }

    public function edit(Record $record)
    {
        return view('admin.records.edit', compact('record'));
    }

    public function update(Request $request, Record $record)
    {
        $request->validate([
            'config_type' => 'required|in:config_a,config_b',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'data' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        $record->update($request->all());

        return redirect()->route('admin.records.index')
            ->with('success', 'Record updated successfully');
    }

    public function destroy(Record $record)
    {
        $record->delete();

        return redirect()->route('admin.records.index')
            ->with('success', 'Record deleted successfully');
    }
}
