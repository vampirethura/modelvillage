<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use \Auth;
use \Input;
use \Session;
use \Redirect;
use App\SysConfig;
use \Common\Check;

class LoginController extends Controller
{

    //protected $module = 'role';
    protected $validSession = false;

    //constructor class
  	public function __construct(){
  		  $this->validSession = Check::validSession(); //return true or false;
  	}

    public function index(){
      //check user session
      if(!$this->validSession) {
        $logo = SysConfig::where('type','SystemSettings')->where('key','crm-company-logo')->first()->value;
        $company_name = SysConfig::where('type','SystemSettings')->where('key','crm-company-name')->first()->value;
        $bg = SysConfig::where('type','SystemSettings')->where('key','crm-login-bg-image')->first()->value;
        $home_url = SysConfig::where('type', 'SystemSettings')->where('key', 'crm-home-url')->first()->value;
        $title = SysConfig::where('type', 'SystemSettings')->where('key', 'crm-login-title')->first()->value;
        //return view ...
        return view('backend.common.loginv1')
              ->with('logo', $logo)
              ->with('bg', $bg)
              ->with('title', $title)
              ->with('company_name', $company_name);
      }

      $home_url = SysConfig::where('type', 'SystemSettings')->where('key', 'crm-home-url')->first()->value;
      //redirect to inner site
      return Redirect::intended($home_url);
    }

    // route to process user login
  	public function store(LoginFormRequest $request){
        $input = Input::all();
        //validate the info, create rules for the inputs
    		$rules = array(
    			'username' => 'required',
    			'password' => 'required|alphanum|min:3'
    		);
    		//run the validator on the input using the rules
    		$validator = Validator::make($input, $rules);

    		//if validator fail redirect back to the form.
    		if($validator->fails())
    		{          
    			return Redirect::to('/crm/login')
    				->withErrors($validator)
    				->withInput(\Input::except('password'));
    		}
    		else
    		{
    			//make user data for authentication.
    			$user = User::where('username', $input['username'])->first();

    			//if user exist, set the user infomation to the session and return success.
    			if (isset($user))
    			{
    				//filter out the user that is not activated. send them message.
    				if($user->activation_status != 'A')
    					return Redirect::to('/crm/login')->withMessage('Please Activate your Account through the email link');
    				if(!isset($user->role_id))
    					return Redirect::to('/crm/login')->withMessage('Role of the user has not been assigned yet, please contact the site admin.');

            $remember_me = Input::get('remember_me');
            $remember_me = ($remember_me && $remember_me == 'on') ? true : false;
    				//check wether the user auth is valid
    				if(Auth::attempt(array('username' => $input['username'], 'password' => $input['password']), $remember_me))
    				{
    					//retrieve the user access and permission
    					//Set them to the session

    					Session::put('user', $user->toArray());
    					Session::put('navtop', User::getNavTop($user->id)['data']);
    					Session::put('sidebar', User::getSidebar($user->id)['data']);
    					Session::put('permissions', User::getUserPermission($user->id)['data']);
    					Session::put('features', User::getUserFeatures($user->id)['data']);
    					//save the user last access;
    					$user->last_access = date("Y-m-d H:i:s");
    					$user->save();

    					return Redirect::intended('/crm/home');
    				}
    				else
    				{
    					//return password mismatched

    					return Redirect::to('/crm/login')
    						->withMessage('Login Not Successful, please try again.')
    						->withInput(\Input::except('password'));
    				}
    			}

    			//else return user not exist.
    			else
    			{
    				//user not exist
    				return Redirect::to('/crm/login')
    					->withMessage('Login Not Successful, please try again.')
    					->withInput(\Input::except('password'));
    			}
    		}
    }

  	//route to do the logout.
  	public function doLogout(){
      Auth::logout();
      //flush session
      Session::flush();

      //redirect user to login page
      return Redirect::to('/crm/login')->withMessage('Logout ...');
    }

  	public function doRelogin()
  	{
  		//flush current session and redriect to login.
  				//flush session
  		Session::flush();

  		//redirect user to login page
  		return Redirect::to('/crm/login')->withMessage('Session Deleted, Please Login again.');

  	}
}
