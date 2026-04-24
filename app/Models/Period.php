<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table = 'periods';
    protected $primaryKey = 'period_id';
    public $timestamps = false;

    protected $fillable = [
        'academic_year_id',
        'name',
        'number',
        'percentage',
        'start_date',
        'end_date',
        'status',
        'active',
    ];

    protected $casts = [
        'active'      => 'boolean',
        'percentage'  => 'decimal:2',
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function academicYear()
    {
        return $this->belongsTo(Academic_year::class, 'academic_year_id', 'id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'period_id', 'id');
    }

    public function periodResults()
    {
        return $this->hasMany(Period_result::class, 'period_id', 'id');
    }

    public function reportObservations()
    {
        return $this->hasMany(Report_observation::class, 'period_id', 'id');
    }
}
