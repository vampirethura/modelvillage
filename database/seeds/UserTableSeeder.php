<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $users = array(
            [
                'id'=>1,
                'role_id'=>1,
                'username'=>'sys',
                'password'=>Hash::make('pwd'),
                'email'=>'min@soloblack.com',
                'display_name'=>'System Admin',
                'super_admin'=>1,
                'activation_status'=>'A',
                'country'=>'SG',
                'about_me'=>'Some description'
            ],
            [
                'id'=>2,
                'role_id'=>2,
                'username'=>'admin1',
                'password'=>Hash::make('pwd'),
                'email'=>'admin1@soloblack.com',
                'display_name'=>'Admin 1',
                'super_admin'=>0,
                'activation_status'=>'A',
                'country'=>'SG',
                'about_me'=>'Some description'
            ],
            [
                'id'=>3,
                'role_id'=>3,
                'username'=>'staff1',
                'password'=>Hash::make('pwd'),
                'email'=>'staff1@soloblack.com',
                'display_name'=>'Staff 1',
                'super_admin'=>0,
                'activation_status'=>'A',
                'country'=>'SG',
                'about_me'=>'Some description'
            ],
            [
                'id'=>4,
                'role_id'=>null,
                'username'=>'toni',
                'password'=>Hash::make('pwd'),
                'email'=>'tonistark@soloblack.com',
                'display_name'=>'Toni Stark',
                'super_admin'=>0,
                'activation_status'=>'A',
                'country'=>'SG',
                'about_me'=>'Some description'
            ]
        );

        DB::table('users')->insert($users);
    }
}
