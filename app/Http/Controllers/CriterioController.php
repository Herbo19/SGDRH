<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Criterio;
use Illuminate\Support\Str;

class CriterioController extends Controller
{
    //
    public function index()
    {
        $criterios = Criterio::all();
        return view('Feedback.criterio.criterio',['criterios'=>$criterios]);
    }

    public function store()
    {
        request()->validate([
            'criterio'=>['required']
        ],[
                'criterio'=>'O criterio está vazio!!!'
        ]);

        Criterio::create([
            'criterio'=>Str::ucfirst(request('criterio'))
        ]);
        return back()->with('msg','Dados salvos com sucesso');

    }

    public function editar($id)
    {
        $criterio =Criterio::find($id);
        return view('Feedback.criterio.editar',['criterio'=>$criterio]);
    }

    public function Atualizar(Request $request, $id)
    {

          $criterio=Criterio::find($id);
          $criterio->criterio=Str::ucfirst($request->criterio);

            if ($criterio->isDirty('criterio') ) {
                session()->flash('msg', 'Tipo de usuário atualizado');
                $criterio->save();
            }else{
                session()->flash('msg', 'Nada foi atualizado!!');
            }

          return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {

        Criterio::where('idCriterio',$id)->delete();
        return back()->with('tipo-eliminado','Dados Eliminados com sucesso');
    }

}
