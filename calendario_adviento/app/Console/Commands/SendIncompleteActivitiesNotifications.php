<?php

namespace App\Console\Commands;

use App\Domains\Notifications\Services\NotificationService;
use Illuminate\Console\Command;

class SendIncompleteActivitiesNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-incomplete-activities-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía las notificaciones de desafíos pendientes';

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
    public function handle(NotificationService $notificationService)
    {
        $notificationService->incompleteActivityRemainder();
        return 0;
    }
}
