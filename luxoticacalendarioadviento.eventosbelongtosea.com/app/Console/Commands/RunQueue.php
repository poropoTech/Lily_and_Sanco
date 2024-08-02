<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-queue {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Arranca la cola de la aplicación';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('queue:listen');
        return 0;
    }
}
