<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meta;
use App\Models\Equipa;
use App\Models\Funcionario;
use App\Models\Titulo;
use App\Models\User;
use App\Models\Estado_meta;
use \Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewGoalNotification;


class MetasEquipaController extends Controller
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
        $teams = Equipa::all();
        return view('Metas.Equipa.criar', compact('teams'));
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
            'team_id'=>'required',
            'titulo_meta'=>'required',
            'data_inicio'=>'required',
            'data_fim'=>'required',
            'descricao_meta'=>'required',
            'atribuido_por'=>'required',
          ]);

          $validation = Validator::make($request->all(), [
            'data_fim' => 'required|date|after_or_equal:data_inicio'
          ]);

          if($validation->fails()){
            //$collection = json_decode($validation->errors());
            return back()->with('col','Erro: A data de fim não pode ser anterior à data de início.
            Certifique-se de que a data de fim é posterior ou igual à data de início.');
          }

            $enTit=new Titulo();
            $enTit->titulo = $request->titulo_meta;
            $enTit->save();
            $endeIdTit = $enTit->idTitulo;


          $meta=new Meta();
          $meta->idEquipa = $request->team_id;
          $meta->idTitulo = $endeIdTit;
          $meta->data_criacao = date('Y-m-d', strtotime($request->data_inicio)) ;
          $meta->data_conclusao = date('Y-m-d', strtotime($request->data_fim)) ;
          $meta->descricao_meta = $request->descricao_meta;
          $meta->atribuido_por = $request->atribuido_por;
          $meta->save();

          $team = $meta->equipas; // Assuming a relationship is set up
            $employees = $team->funcionario; // Assuming a relationship is set up



            foreach ($employees as $employee) {
                $user = User::where('idFuncionario',$employee['id'])->get();
                Notification::send($user, new NewGoalNotification($meta));
            }

         // $notifications = User::find($request->atribuir_para);
        //$notifications->notify(new NewGoalNotification($$notifications));

          return redirect('/metas/equipa/criar')->with('msg','Dados inseridos com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $metas = Meta::whereNotNull('idEquipa')->get();
        return view('Metas.Equipa.verTodasMetas',['metas'=>$metas]);
    }

    public function showMetaEquipa($id)
    {
        $team = Equipa::find($id);
        $teamId = $team->idEquipa;
        $metas = Meta::whereNotNull('idEquipa')->where('idEquipa',$teamId)->get();
        return view('Metas.Equipa.mostrar',['metas'=>$metas, 'team'=>$team]);
    }

    public function mostrarMetaEquipa($id)
    {
        $meta = Meta::find($id);
        return view('Metas.Equipa.mostrarMetaEquipa',['meta'=>$meta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meta = Meta::whereNotNull('idEquipa')->where('idMeta',$id)->first();
        $equipas = Equipa::all();
       // $titulo_meta = Titulo::orderBy('idGenero','desc')->get();
        return view('Metas.Equipa.editar',['meta'=>$meta, 'equipas'=>$equipas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

          $validation = Validator::make($request->all(), [
            'data_fim' => 'required|date|after_or_equal:data_inicio'
          ]);

          if($validation->fails()){
            //$collection = json_decode($validation->errors());
            return back()->with('col','Erro: A data de fim não pode ser anterior à data de início.
            Certifique-se de que a data de fim é posterior ou igual à data de início.');
          }


            $tit = Titulo::where('idTitulo', $request->id_titulo_meta)->first();
            $tit->titulo = $request->titulo_meta;
            if ($tit->update()) {
            $titId = $tit->idTitulo;
            }

          $meta=Meta::find($id);
          $meta->idEquipa = $request->team_id;
          $meta->idTitulo = $titId;
          $meta->data_criacao = date('Y-m-d', strtotime($request->data_inicio)) ;
          $meta->data_conclusao = date('Y-m-d', strtotime($request->data_fim)) ;
          $meta->descricao_meta = $request->descricao_meta;
          $meta->update();


          return back()->with('msg','Dados Alterados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Meta::where('idMeta',$id)->delete();
      return back()->with('col', 'Meta eliminada com sucesso!!');
    }

    public function showOneMeta($id){
        $meta = Meta::whereNotNull('idEquipa')->where('idMeta', $id)->first();
        return view('Metas.Equipa.mostrarUmaMeta',['meta'=>$meta]);
    }

    public function minhaEquipa( $id)
    {
        $user = User::find($id);
        $employeeId= $user->funcionarios->id;
        $employee = Funcionario::find($employeeId);
        $teams = $employee->equipas;

        if ($teams) {
            return view('Metas.Equipa.minhasMetas', compact('teams'));
        } else {
            // Handle case where employee is not found
            return view('/');
        }
    }

    public function editarEstadoMeta($id)
    {
        $editMeta = Meta::find($id);
        $editEstado = Estado_meta::orderBy('idEstadoMeta','desc')->get();
        return view('Metas.Equipa.AtualizarEstado',['editMeta'=>$editMeta,'editEstado'=>$editEstado]);

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
}
