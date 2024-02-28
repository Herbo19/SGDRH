<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=Cargo::orderBy('id','desc')->get();
        return view('Cargo.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Cargo.criar');
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
        'tituloCargo'=>'required',
        'descricao'=>'required',
      ]);

      $data=new Cargo();
      $data->tituloCargo=$request->tituloCargo;
      $data->descricao=$request->descricao;
      $data->save();

      return redirect('cargo/create')->with('msg','Dados inseridos com sucesso');
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
        $data=Cargo::find($id);
        return view('Cargo.mostrar',['data'=>$data]);
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
        $data=Cargo::find($id);
        return view('Cargo.editar',['data'=>$data]);
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
        //
        $request->validate([
          'tituloCargo'=>'required',
          'descricao'=>'required',
        ]);

        $data=Cargo::find($id);
        $data->tituloCargo=$request->tituloCargo;
        $data->descricao=$request->descricao;
        $data->save();

        return redirect('cargo/'.$id.'/edit')->with('msg','Dados Atualizados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function eliminar($id)
     {
         Cargo::where('id',$id)->delete();
         return redirect('cargo');
     }
}
