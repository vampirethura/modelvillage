<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateRoleFormRequest;
use App\Http\Controllers\Controller;
use App\Role;
use App\Feature;
use App\User;
use App\PermissionRole;
use App\FeatureRole;
use \Redirect;
use \Input;
use Common\Generate;
use \Exception;
use Common\ActionSchema;

class RoleController extends Controller
{
    protected $module = "role";

    //constructor class
    public function __construct()
    {
        $this->middleware('auth'); #check user is authenticated/login
        $this->middleware('role'); #check user has the access to this function/module
        $this->middleware('permission'); #check permission access
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $roles = Role::all();
      $actions = ActionSchema::getActionSchema($this->module);
      //return  Feature::test();

      return view('backend.role.index')
            ->with('content_title', "Manage Roles")
            ->with('actions', $actions)
            ->with('roles', $roles)
            ->with('module', $this->module);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.role.create')
            ->with('content_title', "Create Role")
            ->with('module', $this->module);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleFormRequest $request)
    {
        try {
          $inputs = $request->all();
          Role::create($inputs);
          return Redirect::to('/crm/role/')
                ->withMessage(Generate::success_message('Success', 'Created Successfully'));
        } catch (Exception $e) {
          return Redirect::to('/crm/role/')
                ->withMessage(Generate::error_message('Fail', 'Failed to create.'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $role = Role::find($id);
      $actions = ActionSchema::getActionSchema($this->module);
      $permission_ids = PermissionRole::where('role_id', $id)->lists('permission_id')->toArray();
      // return $permission_ids;
      return view('backend.role.show')
            ->with('content_title', "Role Details")
            ->with('role', $role)
            ->with('permission_ids', $permission_ids)
            ->with('actions', $actions)
            ->with('module', $this->module);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $role = Role::find($id);
      return view('backend.role.edit')
            ->with('content_title', "Edit Role")
            ->with('role', $role)
            ->with('module', $this->module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRoleFormRequest $request, $id)
    {
      try {
        $inputs = $request->all();
        Role::find($id)->update($inputs);
        return Redirect::to("/crm/role/$id")
              ->withMessage(Generate::success_message('Success', 'Updated Successfully'));
      } catch (Exception $e) {
        return Redirect::to("/crm/role/$id")
              ->withMessage(Generate::error_message('Fail', 'Failed to update.'));
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        Role::find($id)->delete();
        return Redirect::to('/crm/role/')
              ->withMessage(Generate::success_message('Success', 'Deleted Successfully'));
      } catch (Exception $e) {
        return Redirect::to('/crm/role/')
              ->withMessage(Generate::error_message('Fail', 'Failed to delete.'));
      }
    }

    public function assignRolePermission($role_id){
      try {
        $permissions = Input::get('permissions');
        $inputs = Input::all();
        $permission_ids = PermissionRole::where('role_id', $role_id)->lists('permission_id')->toArray();
        foreach ($permissions as $key => $permission_id) {
          if (in_array($permission_id, $permission_ids) && $inputs["permission_status_$permission_id"] == 'off') {
            //Turn off permission.
            PermissionRole::where('role_id', $role_id)
                          ->where('permission_id', $permission_id)
                          ->delete();
          }elseif(!in_array($permission_id, $permission_ids) && $inputs["permission_status_$permission_id"] == 'on'){
            $new_assign_permission = ['role_id' => $role_id, 'permission_id' => $permission_id, 'order' => 1];
            PermissionRole::create($new_assign_permission);
          }
        }
        return Redirect::to("/crm/role/$role_id")
                        ->withMessage(Generate::success_message('Success', 'Assigned Successfully'));
      } catch (Exception $e) {
        return Redirect::to("/crm/role/$role_id")
              ->withMessage(Generate::error_message('Fail', 'Failed to assign permission.'));
      }

    }

    public function assignRoleFeatureForm($role_id){
      $assigned_feature_ids = FeatureRole::where('role_id', $role_id)->lists('feature_id');
      $features_not_in_role = [];
      if ($assigned_feature_ids) {
        $features_not_in_role = Feature::whereNotIn('id', $assigned_feature_ids)->get();
      }
      $role = Role::find($role_id);
      return view('backend.role.feature_assign')
                  ->with('content_title', "Assign Feature")
                  ->with('features_not_in_role', $features_not_in_role)
                  ->with('role', $role)
                  ->with('module', $this->module);
    }

    public function assignRoleFeature($role_id){
      try {
        $feature_id = Input::get('feature_id');
        $already_assigned = FeatureRole::where('role_id', $role_id)
                                       ->where('feature_id', $feature_id)
                                       ->exists();
        if ($already_assigned) {
          return Redirect::to("/crm/role/$role_id")
                ->withMessage(Generate::error_message('Fail', 'This feature is already assigned to this role.'));
        }
        $new_assign_feature = [
          'role_id' => $role_id,
          'feature_id' => $feature_id,
          'order' => 1
        ];
        FeatureRole::create($new_assign_feature);
        return Redirect::to("/crm/role/$role_id")
                        ->withMessage(Generate::success_message('Success', 'Assigned Successfully'));
      } catch (Exception $e) {
        return Redirect::to("/crm/role/$role_id")
              ->withMessage(Generate::error_message('Fail', 'Failed to assign feature.'));
      }

    }

    public function removeRoleFeature($role_id, $feature_id){
      try {
        FeatureRole::where('role_id', $role_id)
                   ->where('feature_id', $feature_id)
                   ->delete();
        return Redirect::to("/crm/role/$role_id")
                        ->withMessage(Generate::success_message('Success', 'Removed Successfully'));
      } catch (Exception $e) {
        return Redirect::to("/crm/role/$role_id")
              ->withMessage(Generate::error_message('Fail', 'Failed to remove feature.'));
      }

    }

    public function assignRoleUserForm($role_id){
      $not_assigned_users = User::whereNull('role_id')->get();
      $role = Role::find($role_id);
      return view('backend.role.user_assign')
                  ->with('content_title', "Assign User")
                  ->with('not_assigned_users', $not_assigned_users)
                  ->with('role', $role)
                  ->with('module', $this->module);
    }

    public function assignRoleUser($role_id){
      try {
        $user_id = Input::get('user_id');
        $user = User::find($user_id);
        $user->role_id = $role_id;
        $user->save();
        return Redirect::to("/crm/role/$role_id")
                        ->withMessage(Generate::success_message('Success', 'Assigned User Successfully'));
      } catch (Exception $e) {
        return Redirect::to("/crm/role/$role_id")
              ->withMessage(Generate::error_message('Fail', 'Failed to assign user.'));
      }

    }

    public function removeRoleUser($role_id, $user_id){
      try {
        $user = User::find($user_id);
        $user->role_id = null;
        $user->save();
        return Redirect::to("/crm/role/$role_id")
                        ->withMessage(Generate::success_message('Success', 'Removed User Successfully'));
      } catch (Exception $e) {
        return Redirect::to("/crm/role/$role_id")
              ->withMessage(Generate::error_message('Fail', 'Failed to remove user.'));
      }

    }
}
