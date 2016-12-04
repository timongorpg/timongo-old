<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProfessionTableSeeder::class);
        $this->call(CreatureTableSeeder::class);
        $this->call(MasteryTableSeeder::class);
    }
}
