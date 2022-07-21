<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Paciente::with('pacienteMedicos')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateBody = $request->validate([
            'nombre' => 'required',
            'cedula' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'ciudad' => 'required',
            'correo' => 'required'
        ]);
        
        $paciente = Paciente::create($validateBody);

        return response($paciente);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::with('pacienteMedicos')->find($id);

        if (! $paciente) {
            return response(['message' => 'Record Not Found'], 404);
        }

        return response($paciente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response(['message' => 'Record Not Found'], 404);
        }

        $request->nombre ? $paciente->nombre = $request->nombre : null;
        $request->cedula ? $paciente->cedula = $request->cedula : null;
        $request->direccion ? $paciente->direccion = $request->direccion : null;
        $request->telefono ? $paciente->telefono = $request->telefono : null;
        $request->ciudad ? $paciente->ciudad = $request->ciudad : null;
        $request->correo ? $paciente->correo = $request->correo : null;
        $paciente->save();

        return response($paciente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response(['message' => 'Record Not Found'], 404);
        }
        $paciente->delete();

        return response(['message' => 'removed']);
    }
}
