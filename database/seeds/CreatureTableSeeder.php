<?php

use Illuminate\Database\Seeder;
use App\Creature;
use Timongo\Creatures\FileCreaturesRepository;

class CreatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $creatures = (new FileCreaturesRepository)->fetchAll();

        foreach ($creatures as $row) {
            $creature = Creature::whereImage($row->image)->first() ?: new Creature;

            $creature->fill((array)$row)
                ->save();
        }
    }
}
