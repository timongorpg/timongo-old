<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ResetCharacters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:characters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset every progress';

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
        $this->users->all()->each(function ($user) {
            $user->reset()
                ->save();
        });
    }
}
