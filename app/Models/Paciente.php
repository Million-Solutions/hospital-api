<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cedula',
        'direccion',
        'telefono',
        'ciudad',
        'correo'
    ];

    public function pacienteMedicos()
    {
        return $this->hasMany(MedicoPaciente::class)->with('medicos');
    }
}
