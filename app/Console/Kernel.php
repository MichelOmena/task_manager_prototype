<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define o comando Artisan que está disponível.
     *
     * @var array
     */
    protected $commands = [
        Commands\CheckDeadlines::class,
    ];

    /**
     * Defina o agendamento das tarefas.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Agende o comando CheckDeadlines para rodar diariamente
        $schedule->command('inspire')->everyMinute();
    }

    /**
     * Registre os comandos do console para o aplicativo.
     *
     *
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
