<?php

use Illuminate\Database\Seeder;

class FeatureRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feature_role')->delete();

        $pivot = array(
            //sys features
            ['role_id'=>1, 'feature_id'=>1, 'order'=>1],
            ['role_id'=>1, 'feature_id'=>2, 'order'=>2],
            // ['role_id'=>1, 'feature_id'=>3, 'order'=>3],
            // ['role_id'=>1, 'feature_id'=>4, 'order'=>4],
            ['role_id'=>1, 'feature_id'=>5, 'order'=>4],
            ['role_id'=>1, 'feature_id'=>6, 'order'=>5],
            ['role_id'=>1, 'feature_id'=>7, 'order'=>6],
            ['role_id'=>1, 'feature_id'=>8, 'order'=>7],

            //normal admin user
            //['role_id'=>2, 'feature_id'=>4, 'order'=>11],



        );

        DB::table('feature_role')->insert($pivot);
    }
}
