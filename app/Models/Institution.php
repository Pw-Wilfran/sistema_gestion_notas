<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'name', 'dane_code', 'nit', 'resolution', 
        'address', 'phone', 'city', 'is_active'
    ];

    public function academicYears()
    {
        return $this->hasMany(Academic_year::class);
    }
}
