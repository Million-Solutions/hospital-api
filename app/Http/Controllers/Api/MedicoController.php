<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Medico::with(['medicoPacientes', 'hospital'])->get();
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
            'telefono' => 'required',
            'ciudad' => 'required',
            'correo' => 'required',
            'cargo' => 'required',
            'hospital_id' => 'required'
        ]);
        
        $medico = Medico::create($validateBody);

        return response($medico);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medico = Medico::with(['medicoPacientes', 'hospital'])->find($id);

        if (! $medico) {
            return response(['message' => 'Record Not Found'], 404);
        }

        return response($medico);
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
        $medico = Medico::find($id);

        if (!$medico) {
            return response(['message' => 'Record Not Found'], 404);
        }

        $request->nombre ? $medico->nombre = $request->nombre : null;
        $request->telefono ? $medico->telefono = $request->telefono : null;
        $request->ciudad ? $medico->ciudad = $request->ciudad : null;
        $request->correo ? $medico->correo = $request->correo : null;
        $request->cargo ? $medico->cargo = $request->cargo : null;
        $request->hospital_id ? $medico->hospital_id = $request->hospital_id : null;
        $medico->save();

        return response($medico);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response(['message' => 'Record Not Found'], 404);
        }
        $medico->delete();

        return response(['message' => 'removed']);
    }
}
