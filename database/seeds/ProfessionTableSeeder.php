<?php

use Illuminate\Database\Seeder;
use App\Profession;

class ProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professions = [
            [
                'name' => 'Apprentice'
            ],
            [
                'name' => 'Knight'
            ],
            [
                'name' => 'Mage'
            ],
            [
                'name' => 'Hunter'
            ],
        ];

        foreach ($professions as $profession) {
            Profession::create($profession);
        }
    }
}
