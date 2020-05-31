<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\Models\User\User();
        $user->user_type_id = \App\Models\User\UserType::$ADMIN;
        $user->email = "admin@admin.com";
        $user->password = \Illuminate\Support\Facades\Hash::make("admin");
        $user->save();

        $userDetail = new \App\Models\User\UserDetail();
        $userDetail->user_id = $user->id;
        $userDetail->first_name = 'Admin';
        $userDetail->last_name = 'Last';
        $userDetail->sex = 'Male';
        $userDetail->save();
    }
}
