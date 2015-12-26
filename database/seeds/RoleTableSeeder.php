<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $roles = [
            ['id'=>1, 'name'=>'super_admin', 'descr'=>'Super Admin'],
            ['id'=>2, 'name'=>'user_admin', 'descr'=>'User Admin'],
            ['id'=>3, 'name'=>'staff', 'descr'=>'Staff']
        ];

        DB::table('roles')->insert($roles);
    }
}
