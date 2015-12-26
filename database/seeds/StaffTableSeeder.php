<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staffs')->delete();

        $staffs = array(
            ['id'=>1, 'user_id'=>2, 'location_id'=>1, 'staff_no'=>'ADM00001', 'office_no'=>'63911001', 'job_title'=>'Administrator', 'joined_date'=>'2013-01-30'],
            ['id'=>2, 'user_id'=>3, 'location_id'=>1, 'staff_no'=>'SLP00001', 'office_no'=>'63911001', 'job_title'=>'Sales Person', 'joined_date'=>'2013-01-15']
        );


        DB::table('staffs')->insert($staffs);
    }
}
