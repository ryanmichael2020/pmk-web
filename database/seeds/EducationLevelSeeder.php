<?php

use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('education_levels')->insert([
            [
                'level' => 'Primary',
            ],
            [
                'level' => 'Secondary',
            ],
        ]);
    }
}
