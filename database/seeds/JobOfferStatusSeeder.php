<?php

use Illuminate\Database\Seeder;

class JobOfferStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('job_offer_statuses')->insert([
            [
                'status' => 'Pending',
            ],
            [
                'status' => 'Accepted',
            ],
            [
                'status' => 'Rejected',
            ],
            [
                'status' => 'Expired',
            ],
        ]);
    }
}
