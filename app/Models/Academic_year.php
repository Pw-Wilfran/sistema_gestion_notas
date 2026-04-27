<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academic_year extends Model
{
    protected $table = 'academic_years';
    protected $primaryKey = 'academic_year_id';
    public $timestamps = false;

    protected $fillable = ['year', 'active', 'status', 'start_date', 'end_date'];

    protected $casts = [
        'active'      => 'boolean',
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function periods()
    {
        return $this->hasMany(Period::class, 'academic_year_id', 'id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'academic_year_id', 'id');
    }

    public function academicAssignments()
    {
        return $this->hasMany(Academic_assignment::class, 'academic_year_id', 'id');
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
