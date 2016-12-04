<?php

use Illuminate\Database\Seeder;
use App\Creature;

class CreatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $creatures = [
            [
                'name' => 'Snake',
                'image' => 'cobra.gif',
                'level' => 1,
                'health' => 10,
                'attack' => 2,
                'armor' => 0,
                'magic_resistance' => 0,
                'experience' => 8,
                'gold' => 2
            ],
            [
                'name' => 'Toad',
                'image' => 'toad.gif',
                'level' => 1,
                'health' => 13,
                'attack' => 3,
                'armor' => 1,
                'magic_resistance' => 0,
                'experience' => 10,
                'gold' => 3
            ],
            [
                'name' => 'Crawler',
                'image' => 'crawler.gif',
                'level' => 2,
                'health' => 20,
                'attack' => 5,
                'armor' => 2,
                'magic_resistance' => 1,
                'experience' => 18,
                'gold' => 4
            ],
            [
                'name' => 'Angry Sheep',
                'image' => 'sheep.gif',
                'level' => 3,
                'health' => 33,
                'attack' => 8,
                'armor' => 1,
                'magic_resistance' => 0,
                'experience' => 25,
                'gold' => 5
            ],
        ];

        foreach ($creatures as $creature) {
            Creature::create($creature);
        }
    }
}
