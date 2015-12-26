<?php

use Illuminate\Database\Seeder;

class FeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('features')->delete();

        $features = array(
            //Setup
            ['id'=>1, 'group'=>'Setup', 'group_icon'=>'fa-gears', 'name'=>'System Configuration', 'url'=>'/crm/sysconfig', 'descr'=>'System Configuration', 'icon'=>'fa-gear',
             'display'=>1, 'admin'=>1, 'crud'=>1,'module'=>'sysconfig'],
            ['id'=>2, 'group'=>'Setup', 'group_icon'=>'fa-gears', 'name'=>'Settings', 'url'=>'/crm/setting', 'descr'=>'User Settings', 'icon'=>'fa-gear',
             'display'=>1, 'admin'=>0, 'crud'=>1,'module'=>'setting'],
            ['id'=>3, 'group'=>'Setup', 'group_icon'=>'fa-gears', 'name'=>'App Widgets', 'url'=>'/crm/widget', 'descr'=>'Widget', 'icon'=>'fa-bar-chart-o',
             'display'=>1, 'admin'=>1, 'crud'=>1,'module'=>'app_widget'],
            ['id'=>4, 'group'=>'Setup', 'group_icon'=>'fa-gears', 'name'=>'Dashboards', 'url'=>'/crm/dashboard', 'descr'=>'Dashboard Management', 'icon'=>'fa-compass',
             'display'=>1, 'admin'=>1, 'crud'=>1,'module'=>'dashboard'],
            ['id'=>5, 'group'=>'Setup', 'group_icon'=>'fa-gears', 'name'=>'Locations', 'url'=>'/crm/location', 'descr'=>'Location Management', 'icon'=>'fa-compass',
             'display'=>1, 'admin'=>1, 'crud'=>1,'module'=>'location'],


             //Access Control
            ['id'=>6, 'group'=>'Access Control', 'group_icon'=>'fa-users', 'name'=>'Roles', 'url'=>'/crm/role', 'descr'=>'Role Management', 'icon'=>'fa-bar-chart-o',
             'display'=>1, 'admin'=>1, 'crud'=>1,'module'=>'role'],
            ['id'=>7, 'group'=>'Access Control', 'group_icon'=>'fa-users', 'name'=>'Features', 'url'=>'/crm/feature', 'descr'=>'Feature Management', 'icon'=>'fa-bar-chart-o',
             'display'=>1, 'admin'=>1, 'crud'=>1,'module'=>'feature'],
            ['id'=>8, 'group'=>'Access Control', 'group_icon'=>'fa-users', 'name'=>'Users', 'url'=>'/crm/user', 'descr'=>'User Management', 'icon'=>'fa-bar-chart-o',
             'display'=>1, 'admin'=>1, 'crud'=>1,'module'=>'user']
        );


        DB::table('features')->insert($features);
    }
}
