<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        $this->call(UserTableSeeder::class);
    		$this->call(StaffTableSeeder::class);
    		$this->call(LocationTableSeeder::class);
    		$this->call(SysConfigTableSeeder::class);
    		$this->call(FeatureTableSeeder::class);
    		$this->call(RoleTableSeeder::class);
    		$this->call(FeatureRoleTableSeeder::class);
    		$this->call(PermissionTableSeeder::class);
    		$this->call(PermissionRoleTableSeeder::class);
    		$this->call(CountryTableSeeder::class);
    		$this->call(SettingTableSeeder::class);
    		$this->call(LanguageTableSeeder::class);
    		$this->call(CustomerTableSeeder::class);

        Model::reguard();
        $this->command->info('All tables has been seeded!');
    }
}
