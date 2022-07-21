<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'telefono',
        'ciudad',
        'correo',
        'cargo',
        'hospital_id'
    ];

    public function medicoPacientes()
    {
        return $this->hasMany(MedicoPaciente::class)->with('pacientes');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id', 'id');
    }
}
