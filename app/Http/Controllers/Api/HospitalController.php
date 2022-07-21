<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Hospital::all();
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
            'direccion' => 'required',
            'ciudad' => 'required',
            'nit' => 'required'
        ]);
        
        $hospital = Hospital::create($validateBody);

        return response($hospital);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hospital = Hospital::with('medicos')->find($id);

        if (! $hospital) {
            return response(['message' => 'Record Not Found'], 404);
        }

        return response($hospital);
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
        $hospital = Hospital::find($id);

        if (!$hospital) {
            return response(['message' => 'Record Not Found'], 404);
        }

        $request->nombre ? $hospital->nombre = $request->nombre : null;
        $request->direccion ? $hospital->direccion = $request->direccion : null;
        $request->ciudad ? $hospital->ciudad = $request->ciudad : null;
        $request->nit ? $hospital->nit = $request->nit : null;
        $hospital->save();

        return response($hospital);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hospital = Hospital::find($id);

        if (!$hospital) {
            return response(['message' => 'Record Not Found'], 404);
        }
        $hospital->delete();

        return response(['message' => 'removed']);
    }
}
