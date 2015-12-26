<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Language;
use App\Country;
use App\Setting;
use App\Http\Requests\CreateUserFormRequest;
use App\Http\Requests\UpdateUserFormRequest;
use Common\ActionSchema;
use Common\Generate;
use Common\FileUpload;
use \Redirect;
use \Hash;

class UserController extends Controller
{
    protected $module = 'user';

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
        $users = User::all();
        $actions = ActionSchema::getActionSchema($this->module);
        $roles = Role::all();

        return view('backend.user.index')
              ->with('content_title', 'Users')
              ->with('users', $users)
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
      $languages = Language::all();
      $countries = Country::getAll();
      $roles = Role::all();
      $activation_status = Setting::getSettingByType('ActivationStatusType');
      return view('backend.user.create')
            ->with('content_title', 'Add New User')
            ->with('languages', $languages)
            ->with('countries', $countries)
            ->with('roles', $roles)
            ->with('activation_status', $activation_status)
            ->with('module', $this->module);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserFormRequest $request)
    {
      try {
        $inputs = $request->all();
        $display_image = $request->file('display_image');

        $user = new User();
        $user->username = $inputs['username'];
        $user->password = Hash::make($inputs['password']);
        $user->email = $inputs['email'];
        $user->country = $inputs['country'];
        $user->display_name = $inputs['display_name'];
        $user->language = $inputs['language'];
        $user->activation_status = $inputs['activation_status'];
        $user->about_me = $inputs['about_me'];
        $user->role_id = $inputs['role_id'] ? $inputs['role_id'] : null;
        if ($display_image) {
            //Upload Image
            $uploaded_path = FileUpload::upload($display_image);
            $user->display_image = $uploaded_path;
        }
        $save = $user->save();
        return Redirect::to('/crm/user/')
              ->withMessage(Generate::success_message('Success', 'Created Successfully'));
      } catch (Exception $e) {
        return Redirect::to('/crm/user/')
              ->withMessage(Generate::error_message('Failed', $e->getMessage()));
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
        $user = User::find($id);

        return view('backend.user.show')
            ->with('content_title', 'User Information')
            ->with('user', $user)
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
      $user = User::find($id);
      $languages = Language::all();
      $countries = Country::getAll();
      $activation_status = Setting::getSettingByType('ActivationStatusType');
      $roles = Role::all();

      return view('backend.user.edit')
          ->with('content_title', 'Edit User')
          ->with('languages', $languages)
          ->with('countries', $countries)
          ->with('activation_status', $activation_status)
          ->with('user', $user)
          ->with('roles', $roles)
          ->with('module', $this->module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserFormRequest $request, $id)
    {
        try {
          $inputs = $request->all();
          $display_image = $request->file('display_image');

          $user = User::find($id);
          $user->email = $inputs['email'];
          $user->country = $inputs['country'];
          $user->display_name = $inputs['display_name'];
          $user->language = $inputs['language'];
          $user->activation_status = $inputs['activation_status'];
          $user->about_me = $inputs['about_me'];
          $user->role_id = $inputs['role_id'] ? $inputs['role_id'] : null;
          if ($display_image) {
              //Upload Image
              $uploaded_path = FileUpload::upload($display_image);
              $user->display_image = $uploaded_path;
          }
          $save = $user->save();
          return Redirect::to('/crm/user/'.$id)
                ->withMessage(Generate::success_message('Success', 'User Details Updated'));
        } catch (Exception $e) {
          return Redirect::to('/crm/user/'.$id)
                ->withMessage(Generate::error_message('Failed', $e->getMessage()));
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
          User::find($id)->delete();
          return Redirect::to('/crm/user/')
                ->withMessage(Generate::success_message('Success', 'Deleted Successfully.'));
        } catch (Exception $e) {
          return Redirect::to('/crm/user/')
                ->withMessage(Generate::error_message('Failed', $e->getMessage()));
        }

    }
}
