<?php

use Illuminate\Database\Seeder;
use App\Potion;

class PotionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $potions = [
            [
                'name' => 'Healing flask',
                'price' => 15,
                'icon' => 'life-flask.gif',
                'field' => 'life_potions',
            ],
            [
                'name' => 'Mana flask',
                'price' => 15,
                'icon' => 'mana-flask.gif',
                'field' => 'mana_potions',
            ],
            [
                'name' => 'Stamina flask',
                'price' => 30,
                'icon' => 'stamina-flask.gif',
                'field' => 'stamina_potions',
            ]
        ];

        foreach ($potions as $potion) {
            Potion::create($potion);
        }
    }
}
