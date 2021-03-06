<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        $permissions = array(
            [
                'id'=>1,
                'feature_id'=>5,
                'name'=>'create',
                'descr'=>'Create New Locations',
                'module'=>'location',
                'position'=>'panel-default',
                'url'=>'/crm/location/create',
                'icon'=>'fa-plus',
                'icon_bg'=>'btn-primary',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>2,
                'feature_id'=>5,
                'name'=>'show',
                'descr'=>'Show Location Details',
                'module'=>'location',
                'position'=>'table',
                'url'=>'/crm/location/[ID]',
                'icon'=>'fa-file-text-o',
                'icon_bg'=>'btn-success',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>3,
                'feature_id'=>5,
                'name'=>'edit',
                'descr'=>'Edit Location Details',
                'module'=>'location',
                'position'=>'table',
                'url'=>'/crm/location/[ID]/edit',
                'icon'=>'fa-edit',
                'icon_bg'=>'btn-warning',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>4,
                'feature_id'=>5,
                'name'=>'destroy',
                'descr'=>'Delete Location Record',
                'module'=>'location',
                'position'=>'table',
                'url'=>'/crm/location/[ID]',
                'icon'=>'fa-times',
                'icon_bg'=>'btn-danger',
                'page'=>'index',
                'prompt_type'=>'confirm',
                'prompt_title'=>'Delete',
                'prompt_content'=>'Are you sure you wan to delete this record?'
            ],
            [
                'id'=>5,
                'feature_id'=>5,
                'name'=>'multi_destroy',
                'descr'=>'Delete Multiple Records',
                'module'=>'location',
                'position'=>'panel-alert',
                'url'=>'/crm/location/multi_destroy',
                'icon'=>'fa-times-circle-o',
                'icon_bg'=>'btn-danger',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],

            //Permission for @SysConfig
            [
                'id'=>6,
                'feature_id'=>1,
                'name'=>'create',
                'descr'=>'New System Config',
                'module'=>'sysconfig',
                'position'=>'panel-default',
                'url'=>'/crm/sysconfig/create',
                'icon'=>'fa-plus',
                'icon_bg'=>'btn-primary',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>7,
                'feature_id'=>1,
                'name'=>'show',
                'descr'=>'System Config Detail',
                'module'=>'sysconfig',
                'position'=>'table',
                'url'=>'/crm/sysconfig/[SCID]',
                'icon'=>'fa-file-text-o',
                'icon_bg'=>'btn-success',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>8,
                'feature_id'=>1,
                'name'=>'edit',
                'descr'=>'Edit Config Details',
                'module'=>'sysconfig',
                'position'=>'table',
                'url'=>'/crm/sysconfig/[SCID]/edit',
                'icon'=>'fa-edit',
                'icon_bg'=>'btn-warning',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>9,
                'feature_id'=>1,
                'name'=>'destroy',
                'descr'=>'destroy the config record',
                'module'=>'sysconfig',
                'position'=>'table',
                'url'=>'/crm/sysconfig/[SCID]',
                'icon'=>'fa-times',
                'icon_bg'=>'btn-danger',
                'page'=>'index',
                'prompt_type'=>'confirm',
                'prompt_title'=>'delete',
                'prompt_content'=>'Are you sure you wan to delete this record?'
            ],

            #permission for @Settings
            [
                'id'=>10,
                'feature_id'=>2,
                'name'=>'create',
                'descr'=>'Create New Settings',
                'module'=>'setting',
                'position'=>'panel-default',
                'url'=>'/crm/setting/create',
                'icon'=>'fa-plus',
                'icon_bg'=>'btn-primary',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>11,
                'feature_id'=>2,
                'name'=>'show',
                'descr'=>'Show Setting Details',
                'module'=>'setting',
                'position'=>'table',
                'url'=>'/crm/setting/[SID]',
                'icon'=>'fa-file-text-o',
                'icon_bg'=>'btn-success',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>12,
                'feature_id'=>2,
                'name'=>'edit',
                'descr'=>'Edit Settings',
                'module'=>'setting',
                'position'=>'table',
                'url'=>'/crm/setting/[SID]/edit',
                'icon'=>'fa-edit',
                'icon_bg'=>'btn-warning',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>13,
                'feature_id'=>2,
                'name'=>'destroy',
                'descr'=>'Delete config',
                'module'=>'setting',
                'position'=>'table',
                'url'=>'/crm/setting/[SID]',
                'icon'=>'fa-times',
                'icon_bg'=>'btn-danger',
                'page'=>'index',
                'prompt_type'=>'confirm',
                'prompt_title'=>'delete',
                'prompt_content'=>'Are you sure you wan to delete this record?'
            ],

            #permission for App Widget
            [
                'id'=>14,
                'feature_id'=>3,
                'name'=>'create',
                'descr'=>'Create New Widget',
                'module'=>'app_widget',
                'position'=>'panel-default',
                'url'=>'/crm/app_widget/create',
                'icon'=>'fa-plus',
                'icon_bg'=>'btn-primary',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>15,
                'feature_id'=>3,
                'name'=>'show',
                'descr'=>'Show app_widget Details',
                'module'=>'app_widget',
                'position'=>'table',
                'url'=>'/crm/app_widget/[WID]',
                'icon'=>'fa-file-text-o',
                'icon_bg'=>'btn-success',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>16,
                'feature_id'=>3,
                'name'=>'edit',
                'descr'=>'Edit app_widgets',
                'module'=>'app_widget',
                'position'=>'table',
                'url'=>'/crm/app_widget/[WID]/edit',
                'icon'=>'fa-edit',
                'icon_bg'=>'btn-warning',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>17,
                'feature_id'=>3,
                'name'=>'destroy',
                'descr'=>'destroy the config record',
                'module'=>'app_widget',
                'position'=>'table',
                'url'=>'/crm/app_widget/[WID]',
                'icon'=>'fa-times',
                'icon_bg'=>'btn-danger',
                'page'=>'index',
                'prompt_type'=>'confirm',
                'prompt_title'=>'delete',
                'prompt_content'=>'Are you sure you wan to delete this record?'
            ],

            #permission for Dashboard
            [
                'id'=>18,
                'feature_id'=>4,
                'name'=>'create',
                'descr'=>'Create New Dashboard',
                'module'=>'dashboard',
                'position'=>'panel-default',
                'url'=>'/crm/dashboard/create',
                'icon'=>'fa-plus',
                'icon_bg'=>'btn-primary',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>19,
                'feature_id'=>4,
                'name'=>'show',
                'descr'=>'Show dashboard Details',
                'module'=>'dashboard',
                'position'=>'table',
                'url'=>'/crm/dashboard/[DID]',
                'icon'=>'fa-file-text-o',
                'icon_bg'=>'btn-success',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>20,
                'feature_id'=>4,
                'name'=>'edit',
                'descr'=>'Edit dashboards',
                'module'=>'dashboard',
                'position'=>'table',
                'url'=>'/crm/dashboard/[DID]/edit',
                'icon'=>'fa-edit',
                'icon_bg'=>'btn-warning',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>21,
                'feature_id'=>4,
                'name'=>'destroy',
                'descr'=>'destroy the config record',
                'module'=>'dashboard',
                'position'=>'table',
                'url'=>'/crm/dashboard/[DID]',
                'icon'=>'fa-times',
                'icon_bg'=>'btn-danger',
                'page'=>'index',
                'prompt_type'=>'confirm',
                'prompt_title'=>'delete',
                'prompt_content'=>'Are you sure you wan to delete this record?'
            ],

            #permission for @Roles
            [
                'id'=>22,
                'feature_id'=>6,
                'name'=>'create',
                'descr'=>'Create new role',
                'module'=>'role',
                'position'=>'panel-default',
                'url'=>'/crm/role/create',
                'icon'=>'fa-plus',
                'icon_bg'=>'btn-success',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>23,
                'feature_id'=>6,
                'name'=>'show',
                'descr'=>'Show role details',
                'module'=>'role',
                'position'=>'table',
                'url'=>'/crm/role/[RID]',
                'icon'=>'fa-times-circle-o',
                'icon_bg'=>'btn-success',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>24,
                'feature_id'=>6,
                'name'=>'edit',
                'descr'=>'Edit Role Details',
                'module'=>'role',
                'position'=>'panel-default',
                'url'=>'/crm/role/[RID]/edit',
                'icon'=>'fa-file-text',
                'icon_bg'=>'btn-warning',
                'page'=>'show',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>25,
                'feature_id'=>6,
                'name'=>'destroy',
                'descr'=>'Delete Role',
                'module'=>'role',
                'position'=>'panel-with-modal-delete',
                'url'=>'/crm/role/[RID]',
                'icon'=>'fa-times-circle-o',
                'icon_bg'=>'btn-danger',
                'page'=>'index',
                'prompt_type'=>'confirm',
                'prompt_title'=>'delete',
                'prompt_content'=>'Are you sure you wan to delete this record?'
            ],

            #permission for @Features
            [
                'id'=>26,
                'feature_id'=>7,
                'name'=>'create',
                'descr'=>'Create new feature',
                'module'=>'feature',
                'position'=>'panel-default',
                'url'=>'/crm/feature/create',
                'icon'=>'fa-plus',
                'icon_bg'=>'btn-primary',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>27,
                'feature_id'=>7,
                'name'=>'show',
                'descr'=>'Show feature details',
                'module'=>'feature',
                'position'=>'none',
                'url'=>'/crm/feature/[FID]',
                'icon'=>'fa-times-circle-o',
                'icon_bg'=>'btn-success',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>28,
                'feature_id'=>7,
                'name'=>'edit',
                'descr'=>'Edit feature',
                'module'=>'feature',
                'position'=>'panel-default',
                'url'=>'/crm/feature/[FID]/edit',
                'icon'=>'fa-edit',
                'icon_bg'=>'btn-warning',
                'page'=>'show',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>29,
                'feature_id'=>7,
                'name'=>'destroy',
                'descr'=>'Delete Record',
                'module'=>'feature',
                'position'=>'panel-with-modal-delete',
                'url'=>'/crm/feature/[FID]',
                'icon'=>'fa-times-circle-o',
                'icon_bg'=>'btn-danger',
                'page'=>'show',
                'prompt_type'=>'confirm',
                'prompt_title'=>'delete',
                'prompt_content'=>'Are you sure you wan to delete this record?'
            ],

            #permission for @user
            [
                'id'=>30,
                'feature_id'=>8,
                'name'=>'create',
                'descr'=>'Create new user',
                'module'=>'user',
                'position'=>'panel-default',
                'url'=>'/crm/user/create',
                'icon'=>'fa-plus',
                'icon_bg'=>'btn-primary',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>31,
                'feature_id'=>8,
                'name'=>'show',
                'descr'=>'Show user details',
                'module'=>'user',
                'position'=>'table',
                'url'=>'/crm/user/[UID]',
                'icon'=>'fa-file-text-o',
                'icon_bg'=>'btn-success',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>32,
                'feature_id'=>8,
                'name'=>'edit',
                'descr'=>'Edit user',
                'module'=>'user',
                'position'=>'table',
                'url'=>'/crm/user/[UID]/edit',
                'icon'=>'fa-edit',
                'icon_bg'=>'btn-warning',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>33,
                'feature_id'=>8,
                'name'=>'destroy',
                'descr'=>'destroy the user record',
                'module'=>'user',
                'position'=>'table',
                'url'=>'/crm/user/[UID]',
                'icon'=>'fa-times',
                'icon_bg'=>'btn-danger',
                'page'=>'index',
                'prompt_type'=>'confirm',
                'prompt_title'=>'delete',
                'prompt_content'=>'Are you sure you wan to delete this record?'
            ],


            # @permission related access permit
            [
                'id'=>34,
                'feature_id'=>7,
                'name'=>'create_permission',
                'descr'=>'Create permission',
                'module'=>'feature',
                'position'=>'panel-default',
                'url'=>'/crm/feature/[FID]/permission/create',
                'icon'=>'fa-bolt',
                'icon_bg'=>'btn-primary',
                'page'=>'show',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            // [
            //     'id'=>35,
            //     'feature_id'=>7,
            //     'name'=>'show_permission',
            //     'descr'=>'Show details',
            //     'module'=>'feature',
            //     'position'=>'table',
            //     'url'=>'/crm/feature/[FID]/permission/[PID]',
            //     'icon'=>'fa-file-o',
            //     'icon_bg'=>'btn-success',
            //     'page'=>'show',
            //     'prompt_type'=>'none',
            //     'prompt_title'=>null,
            //     'prompt_content'=>null
            // ],
            [
                'id'=>36,
                'feature_id'=>7,
                'name'=>'edit_permission',
                'descr'=>'Edit Details',
                'module'=>'feature',
                'position'=>'table',
                'url'=>'/crm/feature/[FID]/permission/[PID]/edit',
                'icon'=>'fa-edit',
                'icon_bg'=>'btn-warning',
                'page'=>'show',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>37,
                'feature_id'=>7,
                'name'=>'destroy_permission',
                'descr'=>'Delete Record',
                'module'=>'feature',
                'position'=>'table',
                'url'=>'/crm/feature/[FID]/permission/[PID]',
                'icon'=>'fa-times-circle-o',
                'icon_bg'=>'btn-danger',
                'page'=>'show',
                'prompt_type'=>'confirm',
                'prompt_title'=>'delete',
                'prompt_content'=>'Are you sure you wan to delete this record?'
            ],

            # Role Permissions
            [
                'id'=>38,
                'feature_id'=>6,
                'name'=>'user_remove',
                'descr'=>'Remove Role User',
                'module'=>'role',
                'position'=>'user_table',
                'url'=>'/crm/role/[RID]/user/[UID]/remove',
                'icon'=>'fa-times',
                'icon_bg'=>'btn-danger',
                'page'=>'show',
                'prompt_type'=>'remove',
                'prompt_title'=>'Remove User?',
                'prompt_content'=>'Are you sure you wan to Remove this user from this role?'
            ],
            [
                'id'=>39,
                'feature_id'=>5,
                'name'=>'store',
                'descr'=>'Process Location Creation',
                'module'=>'location',
                'position'=>'form',
                'url'=>'/crm/location',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>40,
                'feature_id'=>5,
                'name'=>'update',
                'descr'=>'Process Location Details Update',
                'module'=>'location',
                'position'=>'form',
                'url'=>'/crm/location/[ID]',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>41,
                'feature_id'=>6,
                'name'=>'store',
                'descr'=>'Process Role Creation',
                'module'=>'role',
                'position'=>'form',
                'url'=>'/crm/role',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>42,
                'feature_id'=>6,
                'name'=>'update',
                'descr'=>'Process Role Details Update',
                'module'=>'role',
                'position'=>'form',
                'url'=>'/crm/role/[RID]',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>43,
                'feature_id'=>6,
                'name'=>'feature_assign_form',
                'descr'=>'Assign Feature',
                'module'=>'role',
                'position'=>'form',
                'url'=>'/crm/role/[RID]/feature_assign',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>44,
                'feature_id'=>6,
                'name'=>'feature_assign',
                'descr'=>'Assign Feature',
                'module'=>'role',
                'position'=>'panel-default',
                'url'=>'/crm/role/[RID]/feature_assign',
                'icon'=>'fa-bolt',
                'icon_bg'=>'btn-success',
                'page'=>'show',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>45,
                'feature_id'=>6,
                'name'=>'user_assign_form',
                'descr'=>'Assign User',
                'module'=>'role',
                'position'=>'panel-default',
                'url'=>'/crm/role/[RID]/user_assign',
                'icon'=>'fa-user',
                'icon_bg'=>'btn-success',
                'page'=>'show',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>46,
                'feature_id'=>6,
                'name'=>'user_assign',
                'descr'=>'Assign User',
                'module'=>'role',
                'position'=>'form',
                'url'=>'/crm/role/[RID]/user_assign',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>47,
                'feature_id'=>6,
                'name'=>'feature_remove',
                'descr'=>'Remove Feature',
                'module'=>'role',
                'position'=>'form',
                'url'=>'/crm/role/[RID]/feature/[FID]/remove',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>48,
                'feature_id'=>6,
                'name'=>'permission_assign',
                'descr'=>'Permission Assign',
                'module'=>'role',
                'position'=>'form',
                'url'=>'/crm/role/[RID]/permission_assign',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],

            // @user related permission
            [
                'id'=>49,
                'feature_id'=>8,
                'name'=>'user_search',
                'descr'=>'Search User',
                'module'=>'user',
                'position'=>'form',
                'url'=>'/crm/user/search',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>null,
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>50,
                'feature_id'=>8,
                'name'=>'store',
                'descr'=>'Process User Creation',
                'module'=>'user',
                'position'=>'form',
                'url'=>'/crm/user',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>null,
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>51,
                'feature_id'=>8,
                'name'=>'update',
                'descr'=>'Process User Creation',
                'module'=>'user',
                'position'=>'form',
                'url'=>'/crm/user/[UID]',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>null,
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>52,
                'feature_id'=>7,
                'name'=>'store',
                'descr'=>'process feature creation',
                'module'=>'feature',
                'position'=>'form',
                'url'=>'/crm/feature',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>53,
                'feature_id'=>7,
                'name'=>'update',
                'descr'=>'process feature update',
                'module'=>'feature',
                'position'=>'form',
                'url'=>'/crm/feature/[FID]',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>54,
                'feature_id'=>7,
                'name'=>'store_permission',
                'descr'=>'Process Storing of the permission',
                'module'=>'feature',
                'position'=>'form',
                'url'=>'/crm/feature/[FID]/permission',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'show',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>55,
                'feature_id'=>7,
                'name'=>'update_permission',
                'descr'=>'Process Updating of the permission',
                'module'=>'feature',
                'position'=>'form',
                'url'=>'/crm/feature/[FID]/permission/[PID]',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'show',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>56,
                'feature_id'=>7,
                'name'=>'delete_permission',
                'descr'=>'Process Deleting of the permission',
                'module'=>'feature',
                'position'=>'form',
                'url'=>'/crm/feature/[FID]/permission',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'show',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>57,
                'feature_id'=>2,
                'name'=>'store',
                'descr'=>'store setting to db',
                'module'=>'setting',
                'position'=>'form',
                'url'=>'/crm/setting',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>null,
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>58,
                'feature_id'=>2,
                'name'=>'update',
                'descr'=>'update setting to db',
                'module'=>'setting',
                'position'=>'form',
                'url'=>'/crm/setting/[ID]',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>null,
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>59,
                'feature_id'=>2,
                'name'=>'multi_destroy',
                'descr'=>'destroy multiple record',
                'module'=>'setting',
                'position'=>'panel-alert',
                'url'=>'/crm/setting/multi_destroy',
                'icon'=>'fa-times-circle-o',
                'icon_bg'=>'btn-danger',
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>60,
                'feature_id'=>1,
                'name'=>'store',
                'descr'=>'Store Entry',
                'module'=>'sysconfig',
                'position'=>'form',
                'url'=>'/crm/sysconfig',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ],
            [
                'id'=>61,
                'feature_id'=>1,
                'name'=>'update',
                'descr'=>'Update Entry',
                'module'=>'sysconfig',
                'position'=>'form',
                'url'=>'/crm/sysconfig/[SCID]',
                'icon'=>null,
                'icon_bg'=>null,
                'page'=>'index',
                'prompt_type'=>'none',
                'prompt_title'=>null,
                'prompt_content'=>null
            ]


        );

        DB::table('permissions')->insert($permissions);
    }
}
