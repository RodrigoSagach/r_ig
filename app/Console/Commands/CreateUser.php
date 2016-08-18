<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    use RequiredOptionCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {--admin} {--email=} {--name=} {--last-name=} {--password=} {username} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

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
     * @return mixed
     */
    public function handle()
    {
        $user = new User();

        $user->username  = $this->argument('username');
        $user->email     = $this->requireOption('email', 'Missing E-Mail Address (--email)');
        $user->name      = $this->requireOption('name', 'Missing First Name (--name)');
        $user->last_name = $this->option('last-name');
        $user->password  = $this->option('password') ? bcrypt($this->option('password')) : bcrypt($this->secret('What is the password?'));
        $user->confirmed = true;

        $user->save();
    }
}
