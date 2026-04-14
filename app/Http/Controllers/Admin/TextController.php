<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppText;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function index(Request $request)
    {
        $query = AppText::query();

        if ($request->has('config_type')) {
            $query->where('config_type', $request->config_type);
        }

        $texts = $query->orderBy('key')->paginate(20);
        return view('admin.texts.index', compact('texts'));
    }

    public function edit(AppText $text)
    {
        return view('admin.texts.edit', compact('text'));
    }

    public function update(Request $request, AppText $text)
    {
        $request->validate([
            'value' => 'required|string',
        ]);

        $text->update(['value' => $request->value]);

        return redirect()->route('admin.texts.index')
            ->with('success', 'Text updated successfully');
    }
}
