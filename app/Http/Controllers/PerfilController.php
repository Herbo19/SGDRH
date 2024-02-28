<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Meta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;


class PerfilController extends Controller
{
    public function show($id)
    {
        $userId = User::find($id);
        $employeeId = $userId->funcionarios->id;

        $data=Meta::selectRaw('extract(year FROM data_conclusao) AS year')
            ->distinct()
            ->orderBy('year', 'asc')
            ->get();

        $anos=[];

        foreach ($data as $ano) {
            $anos[]=$ano['year'];
        }

        $dataToBar = Meta::select(
            DB::raw('YEAR(data_conclusao) as year'),
            DB::raw('COUNT(*) as count')
        )
        ->where('atribuir_para', $employeeId)->where('idEstadoMeta','1')
        ->groupBy('year')
        ->orderBy('year')
        ->get();

        $metaEmProg = Meta::where('idEstadoMeta','=','2')->take(10)->get();


        $tasksByYear = Meta::where('atribuir_para', $employeeId)
            ->orderBy('data_conclusao')
            ->get()
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->completion_date)->format('Y');
            });

        $user=User::find($id);
        $allMetas=Meta::all();

        return view('perfil',['tasksByYear' => $tasksByYear,
        'anos'=>$anos, 'id' => $id,'user' => $user, 'metaEmProg'=>$metaEmProg,
        'allMetas'=>$allMetas, 'employeeId'=>$employeeId, 'dataToBar'=>$dataToBar]);


    }

    public function generatePdf($id)
    {
        $dataAtual = Carbon::now();
        $formattedDate = $dataAtual->format('d-m-Y');
        $user=User::find($id);
        $employeeId = $user->funcionarios->id;
       // $allMetas=Meta::all();
       //$metaEmProg = Meta::where('idEstadoMeta','=','2')->take(10)->get();


       $metas = Meta::where('atribuir_para', $employeeId)->get();
       $metaConc = Meta::where('atribuir_para', $employeeId)->where('idEstadoMeta','1')->get();
       $countConc = $metaConc->count();

       $metaNConc = Meta::where('atribuir_para', $employeeId)->where('idEstadoMeta','3')->get();
       $countNConc = $metaNConc->count();

       $metaProg = Meta::where('atribuir_para', $employeeId)->where('idEstadoMeta','2')->get();
       $countProg = $metaProg->count();

       $dataToBars = Meta::select(
            DB::raw('YEAR(data_conclusao) as year'),
            DB::raw('COUNT(*) as count')
        )
        ->where('atribuir_para', $employeeId)->where('idEstadoMeta','1')
        ->groupBy('year')
        ->orderBy('year')
        ->get();

        $completedGoalPercentages = Meta::select(
            DB::raw('YEAR(data_conclusao) as year'),
            DB::raw('SUM(idEstadoMeta=1) as completed_count'),
            DB::raw('COUNT(*) as total_count')
        )
        ->where('atribuir_para', $employeeId)
        ->groupBy(DB::raw('YEAR(data_conclusao)'))
        ->get();


        $dado = ['user' => $user,
                'metas'=>$metas,
                'countConc'=>$countConc,
                'countNConc'=>$countNConc,
                'countProg'=>$countProg,
                'dataToBars'=>$dataToBars,
                'completedGoalPercentages'=>$completedGoalPercentages];

            // Generate the PDF using the Laravel view and data
            $pdf = PDF::loadView('perfilpdf', $dado);

            //Output the PDF to the browser
            return $pdf->stream('Dados de '.$user->funcionarios->nome_completo.
            ' '.$user->funcionarios->sobrenome.'-'.$formattedDate.'.pdf');


    }


    public function showUserPerfil($id)
    {
        $userId = User::find($id);
        $employeeId = $userId->funcionarios->id;

        $data=Meta::selectRaw('extract(year FROM data_conclusao) AS year')
            ->distinct()
            ->orderBy('year', 'asc')
            ->get();

        $anos=[];

        foreach ($data as $ano) {
            $anos[]=$ano['year'];
        }

        $metas = DB::table('metas')
               ->where('atribuir_para', $employeeId)
               ->get();

        $metaEmProg = Meta::where('idEstadoMeta','=','2')->take(10)->get();



        $stateCounts = Meta::select('idEstadoMeta', DB::raw('COUNT(*) as count'))
        ->where('atribuir_para', $employeeId)
        ->groupBy('idEstadoMeta')
        ->get();

        $done=0;
        $prog=0;
        $Ndone=0;

        foreach ($stateCounts as $stateCount) {
            if ($stateCount->idEstadoMeta == '1') {
                $done++;
            }elseif ($stateCount->idEstadoMeta == '2') {
                $prog++;
            }else{
                $Ndone++;
            }
        }

        $metasFunCount = count($metas);
        $metasCompFun = count($data);
        if ($metasFunCount == 0) {
            $yearlyPercentages = 0;
        } elseif ($metasFunCount == 0) {
            # code...
        } else{
            $yearlyPercentages = ($metasCompFun / $metasFunCount) * 100;
        }

        $user=User::find($id);
        $allMetas=Meta::all();

        return view('perfilUser',['yearly_percentages' => $yearlyPercentages,
        'anos'=>$anos, 'id' => $id,'user' => $user, 'metaEmProg'=>$metaEmProg,
        'allMetas'=>$allMetas]);


    }
}
