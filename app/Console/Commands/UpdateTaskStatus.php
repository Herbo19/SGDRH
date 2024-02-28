<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateTaskStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'metas:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualizar o status da meta se as condições forem atendidas';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Checking and updating goal statuses...');

        $currentDate = now();

        // Query goals with progress status and date_completion < current date
        $goalsToUpdate = DB::table('metas')
            ->where('idEstadoMeta', '2')
            ->where('data_conclusao', '<', $currentDate)
            ->get();

        foreach ($goalsToUpdate as $goal) {
            DB::table('metas')
                ->where('idMeta', $goal->idMeta)
                ->update(['idEstadoMeta' => '3']);
        }

        $this->info('Estado das metas atualizado.');
    }
    

}
