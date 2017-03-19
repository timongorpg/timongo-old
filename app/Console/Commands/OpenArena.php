<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Arena;
use Log;

class OpenArena extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'open:arena';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $arenas;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Arena $arenas)
    {
        parent::__construct();
        $this->arenas = $arenas;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->arenas->whereStatus('open')
            ->update(['status' => 'finished']);

        $arena = $this->arenas->newInstance();

        $arena->save();

        Log::info('Arena ' . $arena->id . ' is open.');
    }
}
