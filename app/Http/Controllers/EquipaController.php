<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipa;
use Illuminate\Support\Str;

class EquipaController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Equipa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipas = Equipa::all();
        return view('Equipa.criar',['equipas'=>$equipas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'equipa'=>['required'],
            'descricao'=>['required']
        ],[
                'equipa'=>'O equipa está vazia!!!',
                'descricao'=>'A descrição da equipa está vazia!!!'
        ]);

        Equipa::create([
            'nome_equipa'=>Str::ucfirst(request('equipa')),
            'descricao'=>Str::ucfirst(request('descricao'))
        ]);
        return back()->with('msg','Dados salvos com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipa=Equipa::find($id);
        return view('Equipa.mostrar',['equipa'=>$equipa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipa=Equipa::find($id);
        return view('Equipa.editar',['equipa'=>$equipa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $equipa=Equipa::find($id);
        $equipaNome = $request->equipa_nome;
        $equipaDesc = $request->descricao;
        if (($equipa->nome_equipa !== $equipaNome) || ($equipa->descricao !== $equipaDesc)) {
            $equipa->nome_equipa = Str::ucfirst($equipaNome);
            $equipa->descricao = Str::ucfirst($equipaDesc);
            $equipa->save();
            session()->flash('msg', 'Equipa atualizado com sucesso!');
        }else{
            session()->flash('msg-error', 'Nada foi atualizado!!');
        }


        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        Equipa::where('idEquipa',$id)->delete();
        return back()->with('tipo-eliminado','Dados Eliminados com sucesso');
    }
}
