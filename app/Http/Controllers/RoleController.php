<?php

namespace App\Http\Controllers;
use App\Models\Tipo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $roles = Tipo::orderBy('id')->get();
        return view('Usuario.tipo',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Metas.criar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {


        request()->validate([
            'titulo'=>['required'],
            'descricao'=>['required']
        ],[
                'titulo'=>'O Titulo está vazio!!!',
                'descricao'=>'A Descrição está vazia!!!'
        ]);

        Tipo::create([
            'titulo'=>Str::ucfirst(request('titulo')),
            'descricao'=>Str::ucfirst(request('descricao'))
        ]);
        return back()->with('msg','Dados salvos com sucesso');

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
    public function editar($id)
    {
        $role =Tipo::find($id);
        return view('Usuario.Tipo.editar',['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Atualizar(Request $request, $id)
    {

          $role=Tipo::find($id);
          $role->titulo=Str::ucfirst($request->titulo);
          $role->descricao=Str::ucfirst($request->descricao);

            if ($role->isDirty('titulo') || $role->isDirty('descricao') ) {
                session()->flash('msg', 'Tipo de usuário atualizado');
                $role->save();
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
        if ($id == "1") {
            return back()->with('erro','Não é possivel eliminar!');
        }else {
            Tipo::where('id',$id)->delete();
            return back()->with('tipo-eliminado','Dados Eliminados com sucesso');
        }


    }
}
