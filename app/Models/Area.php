<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['name', 'description', 'is_active'];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
