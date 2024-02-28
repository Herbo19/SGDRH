<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tipo;
use App\Models\Funcionario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::orderby('id','asc')->get();
        return view('Usuario.index',['users'=>$users]);
    }
    public function welcome()
    {
        return view('welcome');
    }

    public function auth(Request $request)
    {
        //
        if (Auth::attempt(['email'=>$request->email, 'senha'=>$request->senha])) {
          // code...
        }else{

        }
    }

    public function login()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$func = Funcionario::orderBy('id','desc')->get();
        $func = Funcionario::whereNotIn('id', function ($query) {
            $query->select('idFuncionario')
                  ->from('users');
        })
        ->get();
        $roles= Tipo::all();
        return view('Usuario.criar',['roles'=>$roles,'func'=>$func]);
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
            'name'=>'required',
            'email'=>'required',
            'avatar'=>'required',
            'password'=>'required',
            'password_confirmation'=>'required',
            'Tipo'=>'required',
            'funcionarioId'=>'required',
          ]);

            $avatar=$request->file('avatar');
            $renomearavatar=time().'.'.$avatar->getClientOriginalExtension();
            $dest=public_path('/img');
            $avatar->move($dest, $renomearavatar);

            if ($request->password != $request->password_confirmation) {
                return redirect('usuario/create')->with('nopass','Senha e confirmação de senha diferentes!!!');
            }

          $dataUser=new User();
          $dataUser->name = $request->name;
          $dataUser->email = $request->email;
          $dataUser->idFuncionario = $request->funcionarioId;
          $dataUser->password = $request->password;
          $dataUser->role = $request->Tipo;
          $dataUser->avatar = $renomearavatar;
          $dataUser->save();


          return redirect('usuario/create')->with('msg','Dados inseridos com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUsuario($id)
    {
        //
        $user=User::find($id);
        return view('Usuario.mostrar',['user'=>$user, 'id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $func = Funcionario::orderBy('id','desc')->get();
        $roles= Tipo::all();
        $userData=User::find($id);
        return view('Usuario.editar',['roles'=>$roles,'userData'=>$userData,'func'=>$func]);
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

        if ($request->hasFile('avatar')) {
            $avatar=$request->file('avatar');
            $renomearAvatar=time().'.'.$avatar->getClientOriginalExtension();
            $dest=public_path('/img');
            $avatar->move($dest, $renomearAvatar);

          }else {
            $renomearAvatar = $request->avatar_ante;
          }


            $userDados = User::find($id);
            $userDados->name = $request->name;
            if ($renomearAvatar !== $request->avatar_ante) {
                $userDados->avatar = $renomearAvatar;
            }
            $userDados->email = $request->email;
            if ($request->password != $userDados->password && $request->password != "") {
                if ($request->password != $request->password_confirmation) {
                    return redirect('usuario/'.$id.'/edit')->with('nopass','Senha e confirmação de senha diferentes!!!');
                }
                $userDados->password = $request->password;
            }

            if ($request->Tipo == '') {
                $userDados->role = $request->role_ante;
            }else{
                $userDados->role = $request->Tipo;
            }

            $userDados->update();

            if ($userDados->isDirty()) {
                return redirect('usuario/'.$id.'/edit')->with('msg','Dados atualizados com sucesso');
            }else{
                 return redirect('usuario/'.$id.'/edit')->with('stg','Nada foi alterado');
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
        User::where('id',$id)->delete();
        return back()->with('msg','Dados Eliminados com sucesso');
    }


    public function autocomplete(Request $request)
    {

        $us = User::select("name as value", "id")

                    ->where('name', 'LIKE', '%'. $request->get('search'). '%')

                    ->get();


        return response()->json($us);

    }

    public function searchUser(Request $request){
        $search_user = $request->user_box;


        if ($search_user != "") {
           $sea = User::where('name', 'LIKE', '%'. $search_user. '%')->first();
           if ($sea) {
            return redirect('perfil/'.$sea->id);
           }else{
            return redirect()->back()->with("estatus","Nenhum Usuário corresponde a pesquisa");
           }
        }else{
            return redirect()->back();
        }
    }
}
