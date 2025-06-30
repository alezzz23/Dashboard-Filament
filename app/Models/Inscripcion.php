<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';
    
    protected $fillable = [
        'codigo_inscripcion',
        'nombre',
        'cedula',
        'email',
        'telefono',
        'profesion',
        'fecha_registro'
    ];
    
    protected $casts = [
        'fecha_registro' => 'datetime'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->codigo_inscripcion)) {
                $model->codigo_inscripcion = 'INSC-' . strtoupper(substr(md5(uniqid()), 0, 8));
            }
            
            if (empty($model->fecha_registro)) {
                $model->fecha_registro = now();
            }
        });
    }
}
