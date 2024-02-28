<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Cargo;
use App\Models\Funcionario;
use App\Models\Genero;
use App\Models\Estado;
use App\Models\Email;
use App\Models\Telefone;



class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Funcionario::orderByDesc('id')->get();
        return view('funcionario.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genero = Genero::orderBy('idGenero','desc')->get();
        $estad = Estado::orderBy('idEstado','asc')->get();
        $data=Departamento::orderBy('id','desc')->get();
        $dado=Cargo::orderBy('id','desc')->get();
        return view('Funcionario.criar',['departamentos'=>$data,'cargos'=>$dado,'generos'=>$genero,'estad'=>$estad]);
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
        'nome_completo'=>'required',
        'sobrenome'=>'required',
        'foto'=>'required|image|mimes:jpg,png,gif',
        'endereco'=>'required',
        'dataNasc'=>'required',
        'genero'=>'required',
        'telefone'=>'required',
        'telefone2'=>'required',
        'estado'=>'required',
      ]);

      $foto=$request->file('foto');
      $renomearFoto=time().'.'.$foto->getClientOriginalExtension();
      $dest=public_path('/imagens');
      $foto->move($dest, $renomearFoto);

      $ende=new Email();
      $ende->email = $request->endereco;
      $ende->save();
      $endeId = $ende->idEmail;


      $tel=new Telefone();
      $tel->telefone = $request->telefone;
      $tel->telefone2 = $request->telefone2;
      $tel->save();
      $telId = $tel->idTelefone;



      $data=new Funcionario();
      $data->id_departamento = $request->depart;
      $data->id_cargo = $request->cargo;
      $data->nome_completo = $request->nome_completo;
      $data->sobrenome = $request->sobrenome;
      $data->foto = $renomearFoto;
      $data->data_nascimento = date('Y-m-d', strtotime($request->dataNasc));
      $data->idTelefone = $telId;
      $data->idEmail = $endeId;
      $data->idEstado = $request->estado;
      $data->idGenero = $request->genero;
      $data->save();


      return redirect('funcionario/create')->with('msg','Dados inseridos com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data=Funcionario::find($id);
      return view('Funcionario.mostrar',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genero = Genero::orderBy('idGenero','desc')->get();
        $estad = Estado::orderBy('idEstado','asc')->get();
        $departs=Departamento::orderBy('id','desc')->get();
        $carg=Cargo::orderBy('id','desc')->get();
        $data=Funcionario::find($id);
        return view('funcionario.editar',['departs'=>$departs,'carg'=>$carg,'data'=>$data,'generos'=>$genero,'estad'=>$estad]);
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


      if ($request->hasFile('foto')) {
        $foto=$request->file('foto');
        $renomearFoto=time().'.'.$foto->getClientOriginalExtension();
        $dest=public_path('/imagens');
        $foto->move($dest, $renomearFoto);

      }else {
        $renomearFoto = $request->foto_ante;
      }

      $data=Funcionario::find($id);
      $ende= Email::find($request->idEmail);
      $ende= Email::where('idEmail', $id)->first();
      $ende->email = $request->endereco ?? 'didntwork@gmail.com';

      if ($ende->update()) {
        $endeId = $ende->idEmail;

        $tel = Telefone::find($request->idTelefone);
        $tel = Telefone::where('idTelefone', $id)->first();
        $tel->telefone = $request->telefone;
        $tel->telefone2 = $request->telefone2;
        if ($tel->update()) {
            $telId = $tel->idTelefone;

        }
        else{
            return redirect('funcionario/'.$id.'/edit')->with('msg','Erro a salvar o telefone');
        }

      }else {
        return redirect('funcionario/'.$id.'/edit')->with('msg','Erro no email');
      }

      $data=Funcionario::find($id);
            $data->id_departamento = $request->depart;
            $data->id_cargo = $request->cargo;
            $data->nome_completo = $request->nome_completo;
            $data->sobrenome = $request->sobrenome;
            if ($renomearFoto !== $request->foto_ante) {
                $data->foto = $renomearFoto;
            }
            $data->data_nascimento = date('Y-m-d', strtotime($request->dataNasc));
            $data->idTelefone = $telId;
            $data->idEmail = $endeId;
            $data->idEstado = $request->estado;
            $data->idGenero = $request->genero;
            $data->update();

            if ($data->isDirty()) {
                return redirect('funcionario/'.$id.'/edit')->with('msg','Dados atualizados com sucesso');
            }else{
                return redirect('funcionario/'.$id.'/edit')->with('stg','Nada foi alterado');
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
      Funcionario::where('id',$id)->delete();
      return redirect('funcionario');
    }

    //Perfil
    public function mostraPerfil(){
      return view('perfil');
    }
}
