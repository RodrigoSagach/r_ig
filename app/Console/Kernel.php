<?php

namespace App\Console;

use App\User;
use App\User\App as UserApp;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\CreateUser::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $users = User::where('is_admin', false)->get();

            foreach ($users as $key => $user)
            {
                $sum_investments = $user->excerpts()->where('type', 'investment')->sum('amount');

                if ($sum_investments > 0)
                {
                    $earn = $sum_investments * (config('settings.earning.percentage') / 100);

                    $user->excerpts()->create([
                        'type' => 'earning',
                        'amount' => $earn,
                        'description' => sprintf('Weekly earning for %.2f USD', format_money($sum_investments)),
                    ]);
                }

                $users->forget($key);
            }
        })->weekly()->mondays();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // $this->command('build {project}', function ($project) {
        //     $this->info('Building project...');
        // });
    }
}
