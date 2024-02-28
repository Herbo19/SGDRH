<?php

namespace App\Http\Controllers;

use App\Models\Estado_meta;
use App\Models\Meta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstadoMetaController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado_meta  $estado_meta
     * @return \Illuminate\Http\Response
     */
    public function show(Estado_meta $estado_meta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado_meta  $estado_meta
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $editMeta = Meta::find($id);
        $editEstado = Estado_meta::orderBy('idEstadoMeta','desc')->get();
        return view('Metas.atualizarMeta',['editMeta'=>$editMeta,'editEstado'=>$editEstado]);

    }
    public function atualizarEstado(Request $request, $id){

        $atualizarEstado = Meta::find($id);
        if($atualizarEstado) {
            $atualizarEstado->idEstadoMeta = $request->estado_meta;
            $atualizarEstado->update();
            session()->flash('msg', 'Estado da meta atualizado com sucesso!!!');
        }

            return back();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado_meta  $estado_meta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado_meta $estado_meta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado_meta  $estado_meta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estado_meta $estado_meta)
    {
        //
    }
}
