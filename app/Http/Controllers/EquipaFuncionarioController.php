<?php

namespace App\Http\Controllers;

use App\Models\EquipaFuncionario;
use App\Models\Funcionario;
use App\Models\Equipa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EquipaFuncionarioController extends Controller
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

    public function addFuncionarioEquipa(Request $request)
    {
        $te = $request->input('team_id');
        $team = Equipa::findOrFail($te);
        $employeeId = $request->input('employee_id');

        $team->funcionario()->attach($employeeId);

        return redirect()->route('equipas.show', $team->idEquipa);

    }

    public function detachEmployee($teamId, $employeeId)
    {
        $team = Equipa::findOrFail($teamId);
        $employee = Funcionario::findOrFail($employeeId);

        $team->funcionario()->detach($employee->id);

        return redirect()->route('equipas.show', $team->idEquipa);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EquipaFuncionario  $equipaFuncionario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Equipa::findOrFail($id);
        $employees = Funcionario::all(); // Retrieve all available teams
        return view('Equipa.funcionario.adicionar', compact('employees', 'team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EquipaFuncionario  $equipaFuncionario
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipaFuncionario $equipaFuncionario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EquipaFuncionario  $equipaFuncionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipaFuncionario $equipaFuncionario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipaFuncionario  $equipaFuncionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipaFuncionario $equipaFuncionario)
    {
        //
    }
}
