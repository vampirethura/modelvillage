<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->delete();

        //permissions mapping for super admin (admin)  ------------------------------------------>
        $role_permission = array(

            # @location - pivots for role:1
            ['role_id'=>1, 'permission_id'=>1, 'order'=>1],
            ['role_id'=>1, 'permission_id'=>2, 'order'=>2],
            ['role_id'=>1, 'permission_id'=>3, 'order'=>3],
            ['role_id'=>1, 'permission_id'=>4, 'order'=>4],
            ['role_id'=>1, 'permission_id'=>5, 'order'=>4],
            ['role_id'=>1, 'permission_id'=>39, 'order'=>5],
            ['role_id'=>1, 'permission_id'=>40, 'order'=>5],

            # @role - pivots for role:1
            ['role_id'=>1, 'permission_id'=>22, 'order'=>1], //create
            ['role_id'=>1, 'permission_id'=>23, 'order'=>1], //show
            ['role_id'=>1, 'permission_id'=>24, 'order'=>1], //edit
            ['role_id'=>1, 'permission_id'=>25, 'order'=>1], //destroy
            ['role_id'=>1, 'permission_id'=>41, 'order'=>5], //store
            ['role_id'=>1, 'permission_id'=>42, 'order'=>5], //update
            ['role_id'=>1, 'permission_id'=>43, 'order'=>5], //feature_assign_form
            ['role_id'=>1, 'permission_id'=>44, 'order'=>5], //feature_assign
            ['role_id'=>1, 'permission_id'=>47, 'order'=>5], //feature_remove
            ['role_id'=>1, 'permission_id'=>45, 'order'=>5], //user_assign_form
            ['role_id'=>1, 'permission_id'=>46, 'order'=>5], //user_assign
            ['role_id'=>1, 'permission_id'=>38, 'order'=>5], //user_remove
            ['role_id'=>1, 'permission_id'=>48, 'order'=>5], //permission_assign

            # @feature - pivots for role:1
            ['role_id'=>1, 'permission_id'=>26, 'order'=>1], //create
            ['role_id'=>1, 'permission_id'=>27, 'order'=>1], //show
            ['role_id'=>1, 'permission_id'=>28, 'order'=>2], //edit
            ['role_id'=>1, 'permission_id'=>29, 'order'=>3], //destroy
            ['role_id'=>1, 'permission_id'=>52, 'order'=>1], //store
            ['role_id'=>1, 'permission_id'=>53, 'order'=>4], //update
            ['role_id'=>1, 'permission_id'=>34, 'order'=>4], //create_permission
            ['role_id'=>1, 'permission_id'=>35, 'order'=>4], //show_permission
            ['role_id'=>1, 'permission_id'=>36, 'order'=>4], //edit_permission
            ['role_id'=>1, 'permission_id'=>37, 'order'=>4], //delete_permission
            ['role_id'=>1, 'permission_id'=>54, 'order'=>4], //store_permission
            ['role_id'=>1, 'permission_id'=>55, 'order'=>4], //update_permission
            ['role_id'=>1, 'permission_id'=>56, 'order'=>4], //delete_permission

            # @setting - pivots for role:1
            ['role_id'=>1, 'permission_id'=>10, 'order'=>1], //create
            ['role_id'=>1, 'permission_id'=>57, 'order'=>1], //store
            ['role_id'=>1, 'permission_id'=>11, 'order'=>1], //show
            ['role_id'=>1, 'permission_id'=>12, 'order'=>1], //edit
            ['role_id'=>1, 'permission_id'=>58, 'order'=>1], //update
            ['role_id'=>1, 'permission_id'=>13, 'order'=>1], //destroy
            ['role_id'=>1, 'permission_id'=>59, 'order'=>1],  //multi_destroy

            # @sysconfig - pivots for role:1
            ['role_id'=>1, 'permission_id'=>6, 'order'=>1], //create
            ['role_id'=>1, 'permission_id'=>60, 'order'=>1], //store
            ['role_id'=>1, 'permission_id'=>7, 'order'=>1], //show
            ['role_id'=>1, 'permission_id'=>8, 'order'=>1], //edit
            ['role_id'=>1, 'permission_id'=>61, 'order'=>1], //update
            //['role_id'=>1, 'permission_id'=>9, 'order'=>1], //destroy

            # @user - pivots for role:1
            ['role_id'=>1, 'permission_id'=>30, 'order'=>1], //create
            ['role_id'=>1, 'permission_id'=>50, 'order'=>1], //store
            ['role_id'=>1, 'permission_id'=>31, 'order'=>2], //show
            ['role_id'=>1, 'permission_id'=>32, 'order'=>3], //edit
            ['role_id'=>1, 'permission_id'=>51, 'order'=>1], //update
            ['role_id'=>1, 'permission_id'=>33, 'order'=>4], //destroy
            ['role_id'=>1, 'permission_id'=>49, 'order'=>1] //user_search




        );

        DB::table('permission_role')->insert($role_permission);
    }
}
