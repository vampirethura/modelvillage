<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Validator;
use \Session;
use \Auth;
use \Common\Generate;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use SoftDeletes, Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $module = 'user';
    protected $dates = ['deleted_at'];
    protected $softDelete = true;
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    # constructor for the class.
  	# sometimes i will use this if the variable is use commonly through out the class.
  	


  	# Relationship -------------------------------------------------------------------------------------------------->
  	# ---------------
  	# One-to-One # hasOne(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)
  	# User have staff info (model, foreign_key, local_key)
  	public function staff()
  	{
  		return $this->hasOne('App\Staff', 'user_id', 'id');
  	}

  	# ---------------
  	# One-to-Many # hasMany(Model, foreign_key, local_key) # belongsTo(Model, local_key, parent_key)
  	# User have many devices
  	public function devices()
  	{
  		return $this->hasMany('App\Device', 'user_id', 'id');
  	}

  	# user have many mobile sessions
  	public function mobile_sessions()
  	{
  		return $this->hasMany('App\MobileSession', 'user_id', 'id');
  	}

  	# User Belongs to One role
  	public function role()
  	{
  		return $this->belongsTo('App\Role', 'role_id', 'id');
  	}

  	# User has many role history -- not implemented yet in this version....
  	public function role_history()
  	{
  		return $this->hasMany('App\RoleHistory', 'user_id', 'id');
  	}

  	# one user can have many dashboard.
  	public function dashboard()
  	{
  		return $this->hasMany('App\Dashboard');
  	}


  	# ---------------
  	# Many-to-Many #belongsToMany(Model, pivot_table, associated_key1, associated_key2)
  	#

    # Functions ----------------------------------------------------------------------------------------------------->
  	# Non Static function, meaning the function define here, will need to intantiate in order to use.
  	# example: $user = new User(); $user->getAuthIndentifier();

  	// abstract class for UserInterface object. usually i dont really care about it.
  	//  Get the unique identifier for the user.
  	public function getAuthIdentifier() { return $this->getKey();}

  	// Get the password for the user.
  	public function getAuthPassword(){ return $this->password; }

  	// Get the remember token.
  	public function getRememberToken(){ return $this->remember_token; }

  	// set the remamber token ...
  	public function setRememberToken($value){ $this->remember_token = $value; }

  	//
  	public function getRememberTokenName(){ return 'remember_token';}

  	// get email
  	public function getReminderEmail(){ return $this->email;}

    # non static funtions ------------------------------------------------------------------------------------------->

  	//handling the image uploads.
  	public function ajaxImageUpload()
  	{
  		$user_id = Input::get('user_id');
  		$file = Input::file('display_image');
  		//get the image folder to store the image, in this case the specific restaurant folder.
  		$image_folder = '/assets/images/users/';

  		//upload the image and return the file path
  		$file_path = Image::uploadImage($file, $image_folder);
  		if($file_path['status'] != 1) return Response::json( ['success'=>false, 'errors'=>$file_path['errors'] ] );

  		$user = User::find($user_id);
  		$user->display_image = $file_path['data'];
  		$user->save();

  		User::updateUserSession();

  		return Response::json(['success'=>true, 'message'=>'Profile Image Updated.', 'file'=>$user->display_image]);
  	}






  	# Static Functions ---------------------------------------------------------------------------------------------->
  	# By static mean that the function declare here, no need to instantiate.
  	# to use, just use the model along with double colon. e.q. User::getUserProfile();

  	// Action scchema for rendering the button
  	public static  function actionSchema()
      {
          $permissions = [];
          $action_schemas = [];

          $permissions = Feature::getPermissionsByModule('user', 'table');
          foreach ($permissions as $permission)
          {
              $action_schemas ['table'][] = ActionSchema::action($permission);
          }

          $panel_permissions = Feature::getPermissionsByModule('user', 'panel-default');
          foreach ($panel_permissions as $panel_permission)
          {
              $action_schemas ['panel-default'][] = ActionSchema::action($panel_permission);
          }

          return $action_schemas;
      }

      //create new user entry to database
      public static function createNew($input)
      {
      	$validated = false;
      	$v = new Services\Validators\UserValidation;
      	$validated = $v->passes();
      	//return ($validated)? "T":"F";

      	$save = false;

      	if($validated)
      	{
      		$user = new User();
      		$user->username = $input['username'];
      		$user->email = $input['email'];
      		$user->password = Hash::make($input['password']);
      		$user->display_name = $input['fullname'];
      		$user->about_me = $input['descr'];
      		$user->role_id = $input['role_id'];
      		$user->language = $input['language'];
      		$user->country = $input['country'];
      		$user->activation_status = 'I';
      		$user->activation_code = Generate::randomString(40);
      		$user->created_by = Session::get('user')['id'];
      		$save = $user->save();

      		if($save)
      		{
      			//Construct the data tobe send.
      			$base_url = URL::to('/');
      			$input = [
      				'receiver'=>$user->email,
      				'title'=>'User Account Activation',
      				'subject'=>'Activate your user account',
      				//data needed by the email template ----
  					'url'=>$base_url.'/crm/user/activate?activation_code='.$user->activation_code.'&uid='.$user->id,
  					'username'=>$user->username,
  					'password'=>$input['password'],
  					'sender_name'=>'System Admin',
      			];
  				$sending = Email::sendActivation($input);

      			return Redirect::to('/crm/user')
      					->withMessage(Generate::message('Success', 'New User Account created. email activation has been sent.'));
      		}

      		return Redirect::to('/crm/user')
      					->withMessage(Generate::message('FAIL', 'Please check with system admin regarding this error.'));

      	}

      	$error_string = "";
      	$errors = $v->getErrors()->all();
      	foreach($errors as $error){
      		$error_string .= $error . ',';
      	}
      	return Redirect::to('/crm/user')
      					->withMessage(Generate::message('FAIL!!!', $error_string) );
      }

      public static function updateInfo($input, $id)
      {
      	$validated = false;
      	$v = new Services\Validators\UserUpdateValidation;
      	$validated = $v->passes();

      	if($validated)
      	{
      		$user = User::find($id);
      		$user->email = $input['email'];
      		$user->country = $input['country'];
      		$user->display_name = $input['display_name'];
      		$user->language = $input['language'];
      		$user->activation_status = $input['activation_status'];
      		$user->about_me = $input['about_me'];

      		$save = $user->save();

      		return Redirect::to('/crm/user/'.$id)
      					->withMessage(Generate::message('Success', 'User Details Updated'));

      	}

      	$error_string = "";
      	$errors = $v->getErrors()->all();
      	foreach($errors as $error)
      	{
      		$error_string .= $error . ',';
      	}
      	return Redirect::to('/crm/user/'.$id)
      					->withMessage(Generate::message('FAIL!!!', $error_string) );
      }

      public static function deleteUser($uid)
      {
      	//find user record
      	$user = User::find($uid);
      	if(!isset($user)) return Redirect::to('/crm/user')
      						->withMessage(Generate::message('Delete Fail', 'User record not found.') );
      	$user->delete();

      	return Redirect::to('/crm/user')
      					->withMessage(Generate::message('Success', 'User record deleted') );

      }

  	//retrieve the user profile ---------------------------------------------------------------------->
  	public static function getUserProfile()
  	{

  		//redirect to error page if it is not login user profile.
  		$user = Session::get('user');
  		if(!isset($user)) Generate::returnMsg('403', '403 Forbidden');
  		$user = User::find($user['id']);
  		$user_info = User::where('users.id', $user['id'])
              ->join('countries', 'users.country', '=', 'countries.code')
  						->select('users.*', 'countries.name as country_name')
  						->first();

  		$user_role = $user->role;

  		$return = [
  			'user_info'=>$user_info->toArray(),
  			'user_role'=>$user_role->toArray()
  		];

  		return Generate::returnMsg('200', 'Profile get success', $return);
  	}// end getUserProfile


  	//get all the user permission -------------------------------------------------------------------->
  	public static function getUserPermission($id)
  	{
  		$permissions = []; //initiate a blank permision.

  		$user = User::find($id);
  		$user_role = $user->role;
  		$user_permissions = $user_role->permissions()->wherePivot('deleted_at', NULL)->get();

  		foreach ($user_permissions as $user_permission)
  		{
  			$permissions [$user_permission->module][] = $user_permission->name;
  		}

  		return Generate::returnMsg('200', 'Success', $permissions);
  	}// end getUserPermission

  	public static function getUserFeatures($id)
  	{
  		$features = [];

  		$user = User::find($id);
  		$user_role = $user->role;
  		$user_features = $user_role->features()->wherePivot('deleted_at', NULL)->get();

  		foreach($user_features as $user_feature)
  		{
  			$features [$user_feature->module] = ['name'=>$user_feature->descr, 'url'=>$user_feature->url];
  		}

  		return Generate::returnMsg('200', 'Success', $features);

  	}


  	// get all sidemenu item that is belong to login's user based on its role ------------------------>
  	public static function getSidebar($id)
  	{
  		$profile = [];
  		$menu = [];
  		$user_features=[];

  		$user = User::find($id);
  		$user_role = $user->role;
  		$profile = [
  			'display_name'=>$user->display_name, //get from user table
  			'image'=>$user->display_image, //get from user table
  			'role'=>$user_role->name //get from user role
  		];

  		//get user features, if user feature not found, it will take empty
  		$user_features = $user_role->features()->where('display', 1)->wherePivot('deleted_at', NULL)->get();

  		foreach ($user_features as $feature)
  		{
  			if(!isset($feature->group) || $feature->group == "")
  			{

  				$menu[$feature->name]['module'] = $feature->module;
  				$menu[$feature->name]['name'] = $feature->name;
  				$menu[$feature->name]['icon'] = $feature->icon;
  				$menu[$feature->name]['url'] = $feature->url;
  				$menu[$feature->name]['isnew'] = 'N';
  				$menu[$feature->name]['submenu'] = [];


  			}
  			else
  			{
  				$menu[$feature->group]['module'] = 'parent-menu';
  				$menu[$feature->group]['name'] = $feature->group;
  				$menu[$feature->group]['icon'] = $feature->group_icon;
  				$menu[$feature->group]['url'] = 'javascript:;';
  				$menu[$feature->group]['isnew'] = 'N';
  				$menu[$feature->group]['submenu'][] = [
  					'module'=>$feature->module,
  					'name'=>$feature->name,
  					'url'=>$feature->url,
  					'icon'=>$feature->icon,
  					'module'=>$feature->module
  				];
  			}
  		}


  		//form the data params / Schema
  		$sidebar = [
  			'profile'=>$profile,
  			#User Access are limited over here. and also in add/filters
  			'menus'=>$menu
  		];

  		return Generate::returnMsg('200', 'Success', $sidebar);
  	}// end getSideBar


  	// get all topmenu item that is belong to login's user based on its role ------------------------->
  	public static function getNavTop($id)
  	{
  		$home_url = "";
  		$company_name = "";
  		$company_logo = "";
  		$return =[];

  		$home_url = SysConfig::where('type', 'SystemSettings')
  						->where('key', 'crm-home-url')
  						->first()
  						->value;

  		$company_name = SysConfig::where('type', 'SystemSettings')
  						->where('key', 'crm-company-name')
  						->first()
  						->value;

  		$company_logo = SysConfig::where('type', 'SystemSettings')
  						->where('key', 'crm-company-logo-sm')
  						->first()
  						->value;

  		//get user
  		$user = User::find($id);
      $member_since = date_format($user->created_at, 'Y-M-d');
      $profile_functions = '/crm/profile';
  		//for the data schema for the top navigation
  		$return = [
  			'home_url'=>$home_url, //get from
  			'company_name'=>$company_name, //get from system config
  			'company_logo'=>$company_logo, //get from system config
  			'user_image'=>$user->display_image,
  			'user_name'=>$user->display_name,
        'member_since'=>$member_since,
  			'profile_functions'=> $profile_functions,
  		];

  		return Generate::returnMsg('200', 'Success', $return);
  	}// end getNaveTop

  	// Reset User password --------------------------------------------------------------------------->
  	public static function resetPassword($email)
  	{

  		$user = User::where('email', $email)->first();




  		if(!isset($user)) return Redirect::to('/crm/login')->withMessage('user account not exist, please try again.');
  		// reset user password
  		$random_pwd = str_random(10);
  		$user->password = Hash::make($random_pwd);
  		$user->save();

  		//send the link to the new user password to user.
  		Mail::send('emails.forgot_password', ['password'=>$random_pwd], function($message) use ($user) {
  		    $message->to($user->email, $user->name)
  		    		->subject('Forgot Password');
  		});

  		//
  		return Redirect::to('/crm/login')->withMessage('Password reset instruction has been sent to the registered email address.');

  	} // end resetPassword


  	// change User password --------------------------------------------------------------------------->
  	public static function changePassword($user_id, $curr_pwd, $new_pwd)
  	{

  		$user = User::find($user_id);
  		if(!isset($user)) return Redirect::to('/crm/profile')
  								->withMessage(['title'=>'Failed', 'body'=>'User Not Exist']);


  		if (Hash::check($curr_pwd, $user->password)) {
  		    // The passwords match, then now change pass to the new password.
  		    $user->password = Hash::make($new_pwd);
  		    $user->save();

  		    return Redirect::to('/crm/profile')
  		    		->withMessage(['title'=>'Success', 'body'=>'Password Change successfully.']);

  		}

  		return Redirect::to('/crm/profile')
  		    		->withMessage(['title'=>'Failed', 'body'=>'Password Mismatch.']);

  	} // end changePassword


  	public static function searchUser($search_term, $assigned=true)
  	{
  		if($assigned)
  		{
  			$user = User::where('email', 'LIKE', '%'.$search_term.'%')->get();
  			return $user;
  		}
  		else
  		{
  			$user = User::where('role_id', null)
  							->where('email', 'LIKE', '%'.$search_term.'%')
  							->get();
  			return $user;
  		}
  	}


      //get certain number of user based on the limit.
      public static function getUsers($limit, $offset=0)
      {
          $users = User::whereNull('users.deleted_at')
          	->join('roles', 'users.role_id', '=', 'roles.id')
          	->select('users.*', 'roles.name as role_name')
              ->skip($offset)->take($limit)->get();

          return $users;
      }

      public static function getAllUsers($limit, $offset=0)
      {
          $users = User::whereNull('deleted_at')
              ->skip($offset)->take($limit)->get();

          return $users;
      }

      # get user that is not assigned any role
      public static function getNoRoleUser()
      {
      	$users = User::whereNull('role_id')
      				->whereNull('deleted_at')
      				->get();

      	return $users;
      }

      //not complete yet. got bug...
      public static function refreshUserSession()
      {
      	$user_id = Session::get('user')['id'];
      	$user = User::find($user_id);
      	if(Auth::login($user) )
      	{
  	    	Session::flush();

  	    	// if()
  			Session::put('user', $user->toArray());
  			Session::put('navtop', User::getNavTop($user_id)['data']);
  			Session::put('sidebar', User::getSidebar($user_id)['data']);
  			Session::put('permissions', User::getUserPermission($user_id)['data']);
  			Session::put('features', User::getUserFeatures($user_id)['data']);

  			return Redirect::to(Session::get('navtop')['home_url']);
      	}
      }

      public static function updateUserSession()
      {
      	$user = User::find(Session::get('user')['id']);
      	Session::put('user', $user);

      	return true;
      }
}
