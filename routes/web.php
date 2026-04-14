<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\RecordController;
use App\Http\Controllers\Admin\TextController;

use App\Http\Controllers\Admin\UISettingController;

Route::get('/', function () {
    return redirect('/admin');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Countries
    Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
    Route::put('/countries/{country}', [CountryController::class, 'update'])->name('countries.update');
    Route::post('/countries/bulk-update', [CountryController::class, 'bulkUpdate'])->name('countries.bulk-update');
    
    // Configs
    Route::get('/configs', [ConfigController::class, 'index'])->name('configs.index');
    Route::get('/configs/{config}/edit', [ConfigController::class, 'edit'])->name('configs.edit');
    Route::put('/configs/{config}', [ConfigController::class, 'update'])->name('configs.update');
    
    // Records
    Route::get('/records', [RecordController::class, 'index'])->name('records.index');
    Route::get('/records/create', [RecordController::class, 'create'])->name('records.create');
    Route::post('/records', [RecordController::class, 'store'])->name('records.store');
    Route::get('/records/{record}/edit', [RecordController::class, 'edit'])->name('records.edit');
    Route::put('/records/{record}', [RecordController::class, 'update'])->name('records.update');
    Route::delete('/records/{record}', [RecordController::class, 'destroy'])->name('records.destroy');
    
    // Texts
    Route::get('/texts', [TextController::class, 'index'])->name('texts.index');
    Route::get('/texts/{text}/edit', [TextController::class, 'edit'])->name('texts.edit');
    Route::put('/texts/{text}', [TextController::class, 'update'])->name('texts.update');
    
    // UI Settings
    Route::get('/ui-settings', [UISettingController::class, 'index'])->name('ui-settings.index');
    Route::post('/ui-settings', [UISettingController::class, 'update'])->name('ui-settings.update');
});
