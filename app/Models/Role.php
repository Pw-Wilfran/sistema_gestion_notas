<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    public $timestamps = false;
 
    protected $fillable = [
        'name',
        'description',
        'active',
    ];
 
    protected $casts = [
        'active' => 'boolean',
    ];
 
    public function usuarios()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
