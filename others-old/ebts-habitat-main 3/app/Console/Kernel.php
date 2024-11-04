<?php

namespace App\Console;

use App\Console\Commands\SendIncompleteActivitiesNotifications;
use Cron\CronExpression;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel.
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('activitylog:clean')->daily();

        if (CronExpression::isValidExpression(getSysSetting('app.notifications.incomplete-activities-cron'))) {
            $schedule->command(SendIncompleteActivitiesNotifications::class)
                ->cron(getSysSetting('app.notifications.incomplete-activities-cron'));
        }

        if (! $this->osProcessIsRunning('app:run-queue id='.config('app.key'))) {
            $schedule->command('app:run-queue id='.config('app.key'))
                ->everyMinute()
                ->appendOutputTo('storage/logs/queue.log');
        }
    }

    protected function scheduleTimezone()
    {
        return 'Europe/Madrid';
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected function osProcessIsRunning($needle)
    {
        // get process status. the "-ww"-option is important to get the full output!
        exec('ps aux -ww', $process_status);

        // search $needle in process status
        $result = array_filter($process_status, function ($var) use ($needle) {
            return strpos($var, $needle);
        });

        // if the result is not empty, the needle exists in running processes
        if (! empty($result)) {
            return true;
        }

        return false;
    }
}
