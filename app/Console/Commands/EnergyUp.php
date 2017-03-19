<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Log;

class EnergyUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'energy:up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command increases everybody\'s energy by one';

    protected $users;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $users)
    {
        parent::__construct();
        $this->users = $users;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('energy up');
        $users = $this->users->all();

        $users->each(function($user) {
            $user->increaseStamina();
            $user->increaseHealth();
            $user->increaseMana();

            $user->save();
        });
    }
}
