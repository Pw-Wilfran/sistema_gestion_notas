<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'document', 'relationship', 
        'phone', 'email', 'address', 'user_id', 'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studentGuardians()
    {
        return $this->hasMany(StudentGuardian::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_guardians');
    }
}
