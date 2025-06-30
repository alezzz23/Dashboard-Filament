<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol_id',
        'activo'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'activo' => 'boolean',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function cursosImpartidos()
    {
        return $this->hasMany(Curso::class, 'profesor_id');
    }

    public function cursosInscritos()
    {
        return $this->belongsToMany(Curso::class, 'estudiantes_cursos', 'estudiante_id', 'curso_id')
            ->withTimestamps();
    }

    public function isAdmin()
    {
        return $this->rol->nombre === 'admin';
    }

    public function isProfesor()
    {
        return $this->rol->nombre === 'profesor';
    }

    public function isEstudiante()
    {
        return $this->rol->nombre === 'estudiante';
    }
}
