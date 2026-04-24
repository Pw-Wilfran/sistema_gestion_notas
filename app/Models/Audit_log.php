<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit_log extends Model
{
    protected $table = 'audit_logs';
    protected $primaryKey = 'id_auditoria';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'table_name',
        'action',
        'old_data',
        'new_data',
        'ip'
    ];

 
    protected $casts = [
        'datos_anteriores' => 'array',
        'datos_nuevos'     => 'array',
        'fecha_hora'       => 'datetime',
    ];
 
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
