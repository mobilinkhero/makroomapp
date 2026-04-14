<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UISetting extends Model
{
    protected $table = 'ui_settings';
    
    protected $fillable = [
        'key',
        'config_type',
        'setting_type',
        'value',
        'label',
        'description',
    ];
}
