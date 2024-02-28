<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Departamento::orderBy('id','desc')->get();
        return view('Departamento.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Departamento.criar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'nome'=>'required',
          'descricao'=>'required',
        ]);

        $data=new Departamento();
        $data->nome=$request->nome;
        $data->descricao=$request->descricao;
        $data->save();

        return redirect('depart/create')->with('msg','Dados inseridos com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data=Departamento::find($id);
      return view('Departamento.mostrar',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Departamento::find($id);
        return view('Departamento.editar',['data'=>$data]);
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
      $request->validate([
        'nome'=>'required',
        'descricao'=>'required',
      ]);

      $data=Departamento::find($id);
      $data->nome=$request->nome;
      $data->descricao=$request->descricao;
      $data->save();

      return redirect('depart/'.$id.'/edit')->with('msg','Dados Atualizados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        Departamento::where('id',$id)->delete();
        return redirect('depart');
    }
}
