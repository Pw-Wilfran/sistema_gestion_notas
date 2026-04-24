<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades';
    protected $primaryKey = 'grade_id';
    public $timestamps = false;

    protected $fillable = [
        'enrollment_id',
        'activity_id',
        'value',
    ];

    protected $casts = [
        'value'          => 'decimal:2',
        'created_at'  => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id', 'id');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }
}
