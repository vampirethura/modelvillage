<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Common\Generate;
use \Common\ActionSchema;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends Model
{
    protected $table = 'roles'; //manual assign the table this model is associated with. usually no need if the model name is the singular of the table name.
    use SoftDeletes; //enabled the softdelete, meaning record wont be deleted instead 'delete_at' timestamp will be set.
    protected $dates = ['deleted_at'];
    protected $module = 'role';

    //protected $fillable = [];
    protected $guarded = ['id']; //this is another way of protecting mass assignment, other than column u specify here, all will be able to mass assigned


    # Relationship -------------------------------------------------------------------------------------------------->
    # ---------------
    # One-to-One # hasOne(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)



    # ---------------
    # One-to-Many # hasMany(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)
    # One role have many users
    public function users()
    {
      return $this->hasMany('App\User', 'role_id', 'id');
    }

    #one role have many role history -- not used at the moment, still developing.....
    public function role_history()
    {
      return $this->hasMany('App\RoleHistory', 'role_id', 'id');
    }


      # ---------------
      # Many-to-Many #belongsToMany(Model, pivot_table, associated_key1, associated_key2)
    # One Role can belong to many permissions, one permission can belong to many role
    public function permissions()
    {
      return $this->belongsToMany('App\Permission', 'permission_role');
    }

    # One role can have many feature, one feature can belong to many role
    public function features()
    {
      return $this->belongsToMany('App\Feature');
    }


    # Functions ----------------------------------------------------------------------------------------------------->

    // renderinng the Manage Page of the Module
    public function makeManagePage()
    {
        $roles = Role::all();
        $actions = Role::actionSchema();

        return View::make('backend.role.index')
                    ->with('roles', $roles)
                    ->with('actions', $actions)
                    ->with('module', $this->module);
    }

    // render the form for create a new entry
    public function makeCreateForm()
    {
        return View::make('backend.role.create')
                    ->with('module', $this->module);
    }

    // render the detail page, or show page.
    public function makeDetailPage($id)
    {
        $role = Role::find($id);
        $features_permissions = Feature::getFeaturePermissions($id);
        //return $features_permissions;

        $users = User::where('role_id', $id)->get();
        //return $features_permissions;
        $actions = Role::actionSchema();

        //return $action;
        return View::make('backend.role.show')
                ->with('actions', $actions)
                ->with('features_permissions', $features_permissions)
                ->with('role', $role)
                ->with('users', $users)
                ->with('module', $this->module);

    }

    // render the edit form
    public function makeEditForm($id)
    {
        $role = Role::find($id);

        return View::make('backend.role.edit')
                ->with('role', $role)
                ->with('module', $this->module);
    }


    //to render assign user role form
    public function makeAssignRoleUserForm($rid)
    {
        $role = Role::find($rid);
        $users = User::getNoRoleUser();

        return View::make('backend.role.user_assign')
                    ->with('role', $role)
                    ->with('users', $users)
                    ->with('module', $this->module);
    }

    // to render Assign Role Feature form
    public function makeAssignRoleFeatureForm($rid)
    {
        $role = Role::find($rid);

        $feature_not_in_role = Role::getFeaturesNotAssignedToCurrentRole($rid);

        return View::make('backend.role.feature_assign')
                    ->with('feature_not_in_role', $feature_not_in_role)
                    ->with('role', $role)
                    ->with('module', $this->module);
    }

    //create new role entry.
    public function createEntry($input)
    {
        //some validation here
        $inputs = Input::all();
        $rules = [
            "name"=>"required",
            "descr"=>"required"
        ];
        $new = $this->doCreate($inputs, $rules);

        //if create function return 1 - Success, !1 - Not Success
        if($new['status'] == 1) {
            //redirect to the url you wan along with the message
            return Redirect::to('/crm/role')
                ->withMessage(Generate::message('SUCCESS', $new['message']));
        }

        //redirect to the proper handling url along with the message
        return Redirect::to('/crm/role')
            ->withMessage(Generate::message('FAILED', $new['message']));
    }

    # update entry ------------------------------->
    public function updateEntry($id)
    {
        $inputs = Input::all();
        $rules = [
            'name'=>'required'
        ];

        $updated = $this->doUpdate($id, $inputs, $rules);

        //if create function return 1 - Success, !1 - Not Success
        if($updated['status'] == 1) {
            //redirect to the url you wan along with the message
            return Redirect::to('/crm/role/'.$id)
                ->withMessage(Generate::message('SUCCESS', $updated['message']));
        }

        //redirect to the proper handling url along with the message
        return Redirect::to('/crm/role/'.$id)
            ->withMessage(Generate::message('FAILED', $updated['message']));
    }# update entry class



    // find and delete the role
    public function deleteEntry($id)
    {
        $inputs = [
            'id'=>$id
        ];
        $rules = [
            'id'=>'required|numeric'
        ];
        $deleted = $this->doDelete($id, $inputs, $rules);

        if($deleted['status'] == 1) {
            return Redirect::to('/crm/role')
                ->withMessage(Generate::message('SUCCESS', $deleted['message']));
        }

        return Redirect::to('/crm/role')
            ->withMessage(Generate::message('FAILED', $deleted['message']));
    }

    // assign user to role
    public function assignRoleUser($rid)
    {
        // get the query string from the url
        $uid = Request::get('uid');

        // find the user and update the user role.
        $user = User::find($uid);
        $user->role_id = $rid;
        $user->save();

        //return response as JSON
        return Response::json($user);
    }

    // assign feature to role
    public function assignRoleFeature($rid)
    {
        $role = Role::find($rid);
        $fid = Input::get('feature_id');

        $role_feature = FeatureRole::createNewPivot($rid, $fid);

        return Redirect::to('/crm/role/'.$rid)
                ->withMessage(Generate::message('Success', 'New Featured Assigned.'));
    }

    //remove user from the role
    public function removeRoleUser($rid, $uid)
    {
        //get the user
        $user = User::find($uid);
        $user->role_id = null;
        $user->save();

        return Redirect::to('/crm/role/'.$rid)
                ->withMessage(Generate::message('Success', 'User Removed'));
    }

    //remove feature from role
    public function removeRoleFeature($rid, $fid)
    {
        //find feature role pivot;
        $feature_role = FeatureRole::whereNull('deleted_at')->where('role_id', $rid)->where('feature_id', $fid)->first();

        $feature_role->delete();

        return Redirect::to('/crm/role/'.$rid)
                ->withMessage(Generate::message('Success', 'Featured Unassigned from this role.'));
    }


    public function assignRolePermission($rid)
    {
        $inputs = Input::all();

        //get all the permission that this role has.
        $current_permissions_id = Role::getPermissionsAssignedToCurrentRole($rid);

        foreach($inputs as $key=>$value)
        {
            $is_permission_added_in_current_role = false;
            if($key == '_token') continue;
            $permission_id = explode("_", $key) [1];
            $is_permission_added_in_current_role = in_array($permission_id, $current_permissions_id);

            if(!$is_permission_added_in_current_role && $value == 'on')
            {
                echo 'ON'; print_r ($current_permissions_id); echo $permission_id.'->'; echo $is_permission_added_in_current_role; echo '<br>';
                //if the permission is not exist, create new permission role record.

                $new_permission = new PermissionRole();
                $new_permission->role_id = $rid;
                $new_permission->permission_id = $permission_id;
                $new_permission->order = '1';
                $new_permission->save();

                //else since it is already exist, and it is on, no need to do anything.

            }
            //if permission is in the current role, but it was turn off.
            else if($is_permission_added_in_current_role)
            {
                if($value == 'off'){
                    echo 'OFF'; print_r ($current_permissions_id); echo $permission_id.'->'; echo $is_permission_added_in_current_role; echo '<br>';
                    //if permission record is exist (true), find and do a delete.

                    $perm = PermissionRole::where('role_id', $rid)->where('permission_id', $permission_id)->first();
                    if(isset($perm)){
                        $perm->delete();
                    }
                    //else it is not exist, do nothing.
                }
                else if($value == 'on')
                {
                    //echo 'ON'; print_r ($current_permissions_id); echo $permission_id.'->'; echo $is_permission_added_in_current_role; echo '<br>';
                    //do nothing ....
                }
            }
        }
        //return '';

        return Redirect::to('/crm/role/'.$rid)->withMessage(Generate::message('Success', 'New Permissions Applied, please relogin to see the changes.'));


    }


    # Static Functions ---------------------------------------------------------------------------------------------->

    // action schema use to render all the button on the role pages.
    public static  function actionSchema()
    {
        $action_schemas = [];

        $permissions = Feature::getPermissionsByModule('role', 'table');
        foreach ($permissions as $permission)
        {
            $action_schemas ['table'][] = ActionSchema::action($permission);
        }

        $panel_permissions = Feature::getPermissionsByModule('role', 'panel-default');
        foreach ($panel_permissions as $panel_permission)
        {
            $action_schemas ['panel-default'][] = ActionSchema::action($panel_permission);
        }

        $panel2_permissions = Feature::getPermissionsByModule('role', 'panel-with-modal-delete');
        foreach ($panel2_permissions as $panel2_permission)
        {
            $action_schemas ['panel-with-modal-delete'][] = ActionSchema::action($panel2_permission);
        }

        $user_table_permissions = Feature::getPermissionsByModule('role', 'user_table');
        foreach ($user_table_permissions as $user_table_permission)
        {
            $action_schemas ['user_table'][] = ActionSchema::action($user_table_permission);
        }

        return $action_schemas;
    }


    // get all the features that is not assigned to the current role.
    public static function getFeaturesNotAssignedToCurrentRole($rid)
    {
        $features = []; $array = [0];

        $features = Role::find($rid)->features()->wherePivot('deleted_at', Null)->get();
        foreach ($features as $f){
            $array [] = $f->id;
        }

        //if(!isset($array)) return [];
        $feature_result = Feature::whereNotIn('id', $array)->get();

        return $feature_result;
    }

    // get all the permission that is not assigned to the current role.
    public static function getPermissionsAssignedToCurrentRole($rid)
    {
        $permissions = []; $array = [];
        $permissions = Role::find($rid)->permissions()->wherePivot('deleted_at', NULL)->get();
        //return $permissions;
        foreach($permissions as $permission)
        {
            $array [] = $permission->id;
        }

        return $array;
    }
}
