<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicoPaciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'medico_id'
    ];

    public function pacientes()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }

    public function medicos()
    {
        return $this->belongsTo(Medico::class, 'medico_id', 'id');
    }
}
