<?php

use Illuminate\Database\Seeder;
use App\Mastery;

class MasteryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masteries = [
            [
                'name' => 'Swordmanship',
                'icon' => 'sword.png',
                'field' => 'sword_level',
            ],
            [
                'name' => 'Toughness',
                'icon' => 'toughness.png',
                'field' => 'strength',
            ],
            [
                'name' => 'Dungeoneering',
                'icon' => 'dungeon.png',
                'field' => 'dungeon_level',
            ],
            [
                'name' => 'Thievery',
                'icon' => 'thievery.png',
                'field' => 'thievery_level',
            ],
            [
                'name' => 'Secret Arts',
                'icon' => 'magic.png',
                'field' => 'secret_level',
            ],
            [
                'name' => 'Luck',
                'icon' => 'luck.png',
                'field' => 'luck_level',
            ],
            [
                'name' => 'Quick Learning',
                'icon' => 'quick_learning.png',
                'field' => 'learning_level',
            ]
        ];

        foreach ($masteries as $mastery) {
            Mastery::create($mastery);
        }
    }
}
