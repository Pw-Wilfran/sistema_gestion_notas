<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'setting_id';
    public $timestamps = false;

    protected $fillable = ['key', 'value', 'description'];

    protected $casts = ['updated_at' => 'datetime'];
}
