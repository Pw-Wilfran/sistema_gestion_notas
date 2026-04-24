<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'teacher_id';
    public $timestamps = false;
 
    protected $fillable = [
        'name',
        'last_name',
        'document',
        'phone',
        'email',
        'user_id',
        'active',
    ];
 
    protected $casts = [
        'active'    => 'boolean',
        'created_at' => 'datetime',
    ];
 
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
 
    public function asignaciones()
    {
        return $this->hasMany(Academic_assignment::class, 'teacher_id', 'id');
    }
 
    public function observacionesBoletin()
    {
        return $this->hasMany(Report_observation::class, 'teacher_id', 'id');
    }
}
