<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppConfig;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $configs = AppConfig::all();
        return view('admin.configs.index', compact('configs'));
    }

    public function edit(AppConfig $config)
    {
        return view('admin.configs.edit', compact('config'));
    }

    public function update(Request $request, AppConfig $config)
    {
        $request->validate([
            'app_title' => 'required|string|max:255',
            'search_placeholder' => 'required|string|max:255',
            'components' => 'nullable|json',
            'feature_flags' => 'nullable|json',
        ]);

        $config->update($request->all());

        return redirect()->route('admin.configs.index')
            ->with('success', 'Configuration updated successfully');
    }
}
