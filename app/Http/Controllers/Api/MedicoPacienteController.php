<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicoPaciente;
use Illuminate\Http\Request;

class MedicoPacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'paciente_id' => 'required',
            'medico_id' => 'required'
        ]);
        
        $medicoPaciente = MedicoPaciente::create($validateBody);

        $medico = MedicoPaciente::with('medicos')->find($medicoPaciente->id);
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
        //
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
        $medicoPaciente = MedicoPaciente::find($id);

        if (!$medicoPaciente) {
            return response(['message' => 'Record Not Found'], 404);
        }

        $request->paciente_id ? $medicoPaciente->paciente_id = $request->paciente_id : null;
        $request->medico_id ? $medicoPaciente->medico_id = $request->medico_id : null;
        $medicoPaciente->save();

        return response($medicoPaciente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicoPaciente = MedicoPaciente::find($id);

        if (!$medicoPaciente) {
            return response(['message' => 'Record Not Found'], 404);
        }
        $medicoPaciente->delete();

        return response(['message' => 'removed']);
    }
}
