<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\AppConfig;
use App\Models\Record;
use App\Models\AppText;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_countries' => Country::count(),
            'whitelisted_countries' => Country::where('is_whitelisted', true)->count(),
            'total_records' => Record::count(),
            'active_records' => Record::where('is_active', true)->count(),
            'config_a_records' => Record::where('config_type', 'config_a')->count(),
            'config_b_records' => Record::where('config_type', 'config_b')->count(),
            'total_texts' => AppText::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
