<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $table="asignaturas";

    protected $fillable = [
        'id',
        'nombre',
        'creditos',
        'id_docente',
        'prerrequisito',
        'trabajoDirigido',
        'trabajoAutonomo'
    ];

    public function docente(){
        return $this->belongsTo(usuario::class, 'id_docente');
    }

}
