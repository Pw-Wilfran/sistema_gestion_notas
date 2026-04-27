<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceLevel extends Model
{
    protected $fillable = ['name', 'min_score', 'max_score', 'is_active'];
}
