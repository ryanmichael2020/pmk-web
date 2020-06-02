<?php

use Illuminate\Database\Seeder;

class JobPostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('job_post_statuses')->insert([
            [
                'status' => 'Open',
            ],
            [
                'status' => 'Filled',
            ],
            [
                'status' => 'Cancelled',
            ],
        ]);
    }
}
