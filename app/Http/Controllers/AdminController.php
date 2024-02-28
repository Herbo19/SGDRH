<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Departamento;
use App\Models\Funcionario;
use App\Models\Meta;
use App\Models\Equipa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //Dashboard
    public function index(){

        if (Auth::check()) {
            $data=Funcionario::select('id','created_at')->get()->groupBy(function($data){
                return Carbon::parse($data->created_at)->format('M');
            });



              $meses=[];
              $mesesCount=[];
              $numFun=0;

              foreach ($data as $mes => $valores) {
                $meses[]=$mes;
                $mesesCount[]=count($valores);
              }
              foreach ($mesesCount as $count) {
                  $numFun= $numFun+ $count;
              }

              $den = Departamento::all();
              $numDep = count($den);

              $equipa = Equipa::all();
              $numEquipa = count($equipa);


              $metaConcluida = Meta::select('idEstadoMeta')
              ->where('idEstadoMeta', '=', '1')
              ->get();

              $metaProgresso = Meta::select('idEstadoMeta')
              ->where('idEstadoMeta', '=', '2')
              ->get();

              $mp = $metaProgresso->count();

              $metaNConcluida = Meta::select('idEstadoMeta')
              ->where('idEstadoMeta', '=', '3')
              ->get();

              $mn = $metaNConcluida->count();

              $mc = $metaConcluida->count();

              $countConc = Meta::all();

            $concluida = ( $metaConcluida->count() / $countConc->count()) * 100;
            $concluidas = round($concluida, 1);

              $metaNum = count($countConc);


                $daBar = Meta::select(
                    DB::raw('YEAR(data_conclusao) as year'),
                    DB::raw('COUNT(*) as count')
                )
                ->where('idEstadoMeta','1')
                ->groupBy('year')
                ->orderBy('year')
                ->get();

                $Concemployees = Funcionario::select('funcionarios.*')
                ->selectSub(function ($query) {
                    $query->from('metas')
                        ->whereColumn('metas.atribuir_para', 'funcionarios.id')
                        ->where('metas.idEstadoMeta', '1')
                        ->selectRaw('COUNT(*)');
                }, 'completed_tasks_count')
                ->selectSub(function ($query) {
                    $query->from('metas')
                        ->whereColumn('metas.atribuir_para', 'funcionarios.id')
                        ->selectRaw('COUNT(*)');
                }, 'total_tasks_count')
                ->orderByDesc('completed_tasks_count')
                ->get();

                $employees = Funcionario::select('funcionarios.*')
                ->selectSub(function ($query) {
                    $query->from('metas')
                        ->whereColumn('metas.atribuir_para', 'funcionarios.id')
                        ->selectRaw('COUNT(*)');
                }, 'total_tasks_count')
                ->selectSub(function ($query) {
                    $query->from('metas')
                        ->whereColumn('metas.atribuir_para', 'funcionarios.id')
                        ->where('metas.idEstadoMeta', '1')
                        ->selectRaw('COUNT(*)');
                }, 'completed_tasks_count')
                ->orderBy('completed_tasks_count')
                ->get();

                $teamGoals = DB::table('metas')
                    ->select('idEquipa', DB::raw('SUM(CASE WHEN idEstadoMeta = "1" THEN 1 ELSE 0 END) as completed_count'), DB::raw('COUNT(*) as total_count'))
                    ->groupBy('idEquipa')
                    ->orderByDesc('completed_count')
                    ->get();

                $teamGoals = $teamGoals->map(function ($item) {
                    $item->percentage = ($item->completed_count / $item->total_count) * 100;
                    return $item;
                });

                $goalCompletionPercentages = Meta::selectRaw('YEAR(data_conclusao) as year,
                    SUM(idEstadoMeta = 1) as completed_count,
                    COUNT(*) as total_count')
                    ->groupBy(DB::raw('YEAR(data_conclusao)'))
                    ->get();

                    $completedGoalPercentages = Meta::select(
                        DB::raw('YEAR(data_conclusao) as year'),
                        DB::raw('SUM(idEstadoMeta=1) as completed_count'),
                        DB::raw('COUNT(*) as total_count')
                    )
                    ->whereNotNull('idEquipa')
                    ->groupBy(DB::raw('YEAR(data_conclusao)'))
                    ->get();




        return view('index',['data'=>$data,'meses'=>$meses,'mesesCount'=>$mesesCount,
            'numFun'=>$numFun,'numDep'=>$numDep, 'concluidas'=>$concluidas,
            'mp'=>$mp, 'mn'=>$mn, 'mc' =>$mc, 'employees'=>$employees,
            'metaNum'=>$metaNum, 'daBar'=>$goalCompletionPercentages, 'Concemployees'=>$Concemployees,
            'numEquipa'=>$numEquipa, 'teamGoals'=>$teamGoals,
            'completedGoalPercentages'=>$completedGoalPercentages
        ]);
        }
        return redirect('/login');

    }

    //Login
    public function login(){
      return view('login');
    }

    //Submeter Login
    public function submeter_login(Request $request){
      $request->validate([
        'email'=>'required',
        'senha'=>'required'
      ],[
        'email.required'=>'Email é obrigatório',
        'senha.required'=>'Senha é obrigatória'
      ]);

      $verAdmin=Admin::where(['email'=>$request->email, 'senha'=>$request->senha])->count();

      if ($verAdmin>0) {
        session(['adminLogin', true]);
        return redirect('admin');
      }else{
        return redirect('/')->with('msg','Email ou senha Invalidos!!');
      }

    }

    //Logout
    public function logout(){

        auth()->logout();
      return redirect('/login');

    }



    public function indexRelatorio(){
        return view('Relatorio.index');
    }
}
