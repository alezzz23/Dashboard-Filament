<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public $timestamps = true;

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'rol_id');
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}
