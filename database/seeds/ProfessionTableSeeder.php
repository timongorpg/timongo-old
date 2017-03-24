<?php

use App\Profession;
use Illuminate\Database\Seeder;

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
                'name' => 'Apprentice',
            ],
            [
                'name' => 'Knight',
            ],
            [
                'name' => 'Mage',
            ],
            [
                'name' => 'Hunter',
            ],
        ];

        foreach ($professions as $profession) {
            Profession::create($profession);
        }
    }
}
