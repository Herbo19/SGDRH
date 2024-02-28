<?php

namespace App\Http\Controllers;
use App\Models\Meta;
use App\Models\Titulo;
use App\Models\User;
use App\Models\Estado_meta;
use App\Models\Funcionario;
use \Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewGoalNotification;


use Illuminate\Http\Request;

class MetasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meta = Meta::whereNotNull('atribuir_para')->orderBy('idMeta', 'desc')->get();
        $stat = Estado_meta::all();
        return view('Metas.index',['meta'=>$meta,'stat'=> $stat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = User::all();
        $titul = Titulo::all();
        $funci = Funcionario::all();
        $estado_meta = Estado_meta::all();

        return view('Metas.criar',['usuarios'=>$usuario,'titulos'=>$titul,'funci'=>$funci,'estado_meta'=>$estado_meta]);
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
            'atribuir_para'=>'required',
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
            return back()->with('col','A data inicio tem que ser maior que a data fim');
          }

            $enTit=new Titulo();
            $enTit->titulo = $request->titulo_meta;
            $enTit->save();
            $endeIdTit = $enTit->idTitulo;

            $findFunc = Funcionario::where('nome_completo','=', $request->atribuir_para)->first();
            if ($findFunc) {
                $endeIdFunc = $findFunc->id;
            }else {
                return redirect('metas/create')->with('col','Funcionario não existe!');
            }

          $meta=new Meta();
          $meta->atribuir_para = $endeIdFunc;
          $meta->idTitulo = $endeIdTit;
          $meta->data_criacao = date('Y-m-d', strtotime($request->data_inicio)) ;
          $meta->data_conclusao = date('Y-m-d', strtotime($request->data_fim)) ;
          $meta->descricao_meta = $request->descricao_meta;
          $meta->atribuido_por = $request->atribuido_por;
          $meta->save();

          $user= User::where('idFuncionario',$endeIdFunc)->first();
          Notification::send($user, new NewGoalNotification($meta));

         // $notifications = User::find($request->atribuir_para);
        //$notifications->notify(new NewGoalNotification($$notifications));

          return redirect('metas/create')->with('msg','Dados inseridos com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $meta=Meta::find($id);
        if ($meta->atribuir_para) {
            return view('Metas.mostrar',['meta'=>$meta]);
        }else{
            return view('Metas.Equipa.mostrarMetaEquipa',['meta'=>$meta]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meta = Meta::find($id);
        $funcs = Funcionario::all();
       // $titulo_meta = Titulo::orderBy('idGenero','desc')->get();
        return view('Metas.editar',['meta'=>$meta, 'funcs'=>$funcs]);
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

        $validation = Validator::make($request->all(), [
            'data_conclusao' => 'required|date|after:data_criacao'
          ]);

          if($validation->fails()){
            //$collection = json_decode($validation->errors());
            return back()->with('stg','A data inicio tem que ser maior que a data fim');
          }

          $tit = Titulo::where('idTitulo', $request->id_titulo_meta)->first();
            $tit->titulo = $request->titulo_meta;
            if ($tit->update()) {
            $titId = $tit->idTitulo;
            }


        $metaDados = Meta::find($id);
        $metaDados->idTitulo = $titId;
        $metaDados->atribuir_para = $request->atribuir_para;
        $metaDados->data_criacao = $request->data_criacao;
        $metaDados->data_conclusao = $request->data_conclusao;
        $metaDados->descricao_meta = $request->descricao_meta;
        $metaDados->data_criacao = date('Y-m-d', strtotime($request->data_criacao));
        $metaDados->data_conclusao = date('Y-m-d', strtotime($request->data_conclusao));
        $metaDados->update();


            if (!$metaDados->isDirty()) {
                return redirect('metas/'.$id.'/edit')->with('msg','Dados atualizados com sucesso');
            }else{
                 return redirect('metas/'.$id.'/edit')->with('stg','Nada foi alterado');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        Meta::where('idMeta',$id)->delete();
      return redirect('metas');
    }

    public function minhasmetas(){
        $meta = Meta::all();
        $estatu = Estado_meta::all();
        return view('Metas.metas',['meta'=>$meta,'estatu'=> $estatu]);
    }


    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = Funcionario::where('nome_completo', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    }

}
