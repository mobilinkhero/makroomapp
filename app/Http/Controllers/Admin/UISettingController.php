<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UISetting;
use Illuminate\Http\Request;

class UISettingController extends Controller
{
    public function index(Request $request)
    {
        $configType = $request->get('config_type', 'config_a');
        $settings = UISetting::where('config_type', $configType)->get();
        
        return view('admin.ui-settings.index', compact('settings', 'configType'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*.id' => 'required|exists:ui_settings,id',
            'settings.*.value' => 'required',
        ]);

        foreach ($validated['settings'] as $settingData) {
            $setting = UISetting::find($settingData['id']);
            $setting->update(['value' => $settingData['value']]);
        }

        return redirect()->back()->with('success', 'UI settings updated successfully');
    }
}
