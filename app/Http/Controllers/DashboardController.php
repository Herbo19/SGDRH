<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\User;
use App\Models\Meta;
use App\Models\Cargo;
use App\Models\Equipa;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class DashboardController extends Controller
{
    public function index($id)
    {
        $userId = User::find($id)->first();
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
        $metas = Meta::orderBy('data_conclusao','desc')->get();
        $tableMetas = Meta::where('idEstadoMeta','2')->orderBy('data_conclusao','desc')->get();
        $metaState = Meta::where('atribuir_para',$user->funcionarios->id);

        $completedTasksByYear = Meta::select(
            DB::raw('YEAR(data_conclusao) as year'),
            DB::raw('COUNT(*) as count')
        )
        ->where('atribuir_para', $employeeId)->where('idEstadoMeta','1')
        ->groupBy('year')
        ->orderBy('year')
        ->get();

        $employee = Funcionario::findOrFail($employeeId);
        $goals = Meta::where('idEstadoMeta', '1')->where('atribuir_para',$employee->id)->get();

        $goalsByYear = [];

        foreach ($goals as $goal) {
            $year = Carbon::parse($goal->data_conclusao)->year;

            if (!isset($goalsByYear[$year])) {
                $goalsByYear[$year] = 0;
            }

            $goalsByYear[$year]++;
        }

        $totalGoals = count($goals);
        $percentages = [];

        foreach ($goalsByYear as $year => $goalCount) {
            $percentage = ($goalCount / $totalGoals) * 100;
            $percentages[$year] = $percentage;
        }




    return view('Dashboard',['yearly_percentages' => $yearlyPercentages,
        'anos'=>$anos, 'id' => $id,'user' => $user, 'metas'=>$metas,
        'metaState'=>$metaState, 'completedTasksByYear'=>$completedTasksByYear,
    'percentages'=>$percentages, 'tableMetas'=>$tableMetas ]);
    }

    public function generatePdfAdmin()
    {

        $dataAtual = Carbon::now();
        $formattedDate = $dataAtual->format('d-m-Y');


        $Fun = Funcionario::all();
        $FunCount = count($Fun);

        $Dep = Departamento::all();
        $DepCount = count($Dep);

        $Car = Cargo::all();
        $CarCount = count($Car);

        $equipa = Equipa::all();
        $equipaCount = count($equipa);

        $metaConcluidas = Meta::where('idEstadoMeta','1')->get();
        $concluidaCount = count($metaConcluidas);

        $metaNConcluidas = Meta::where('idEstadoMeta','3')->get();
        $nconcluidaCount = count($metaNConcluidas);

        $metaProg = Meta::where('idEstadoMeta','2')->get();
        $progCount = count($metaProg);

        $meta = Meta::all();
        $totalMetas = count($meta);

        $goalsPerYear = Meta::selectRaw('YEAR(data_conclusao) as year, COUNT(*) as goal_count')
        ->where('idEstadoMeta', '1')
        ->groupBy(DB::raw('YEAR(data_conclusao)'))
        ->get();

        $goalCompletionPercentages = Meta::selectRaw('YEAR(data_conclusao) as year,
        SUM(idEstadoMeta = 1) as completed_count,
        COUNT(*) as total_count')
        ->groupBy(DB::raw('YEAR(data_conclusao)'))
        ->get();


        $dado = ['CarCount' => $CarCount,
                'DepCount'=>$DepCount,
                'FunCount'=>$FunCount,
                'equipaCount'=>$equipaCount,
                'Fun'=>$Fun,
                'Dep'=>$Dep,
                'Car'=>$Car,
                'equipa'=>$equipa,
                'concluidaCount'=>$concluidaCount,
                'nconcluidaCount'=>$nconcluidaCount,
                'progCount'=>$progCount,
                'totalMetas'=>$totalMetas,
                'goalsPerYear'=>$goalsPerYear,
                'goalCompletionPercentages'=>$goalCompletionPercentages
        ];

            // Generate the PDF using the Laravel view and data
            $pdf = PDF::loadView('PDF.dashboardPDF', $dado);

            //Output the PDF to the browser
            return $pdf->stream('Dados de Admin Dashboard'.'-'.$formattedDate.'.pdf');


    }



}
