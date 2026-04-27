<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, 'student_guardians');
    }

    protected $table = 'students';
    protected $primaryKey = 'id_estudiante';
    public $timestamps = false;
 
    protected $fillable = [
        'nombre',
        'apellido',
        'documento',
        'fecha_nacimiento',
        'telefono',
        'email',
        'activo',
    ];
 
    protected $casts = [
        'activo'          => 'boolean',
        'fecha_nacimiento'=> 'date',
        'creado_en'       => 'datetime',
    ];
 
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'id_estudiante', 'id_estudiante');
    }
}
