<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
 
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
 
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'username',
        'password',
        'username',
        'active',
        'role_id',
        'activo',
    ];
 
    protected $hidden = [
        'password',
        'remember_token',
        'created_at'     => 'datetime',
        'updated_at'=> 'datetime',
    
    ];
 
    protected $casts = [
        'active'        => 'boolean'
    ];
 
    // Compatibilidad con Auth de Laravel
    public function getAuthPassword(): string
    {
        return $this->password_hash;
    }

    public function signatures()
    {
        return $this->hasMany(Signature::class);
    }
 
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_rol', 'id_rol');
    }
 
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'id_usuario', 'id_usuario');
    }
 
    public function audit_logs()
    {
        return $this->hasMany(Audit_log::class, 'id_usuario', 'id_usuario');
    }


    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
