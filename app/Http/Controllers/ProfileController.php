<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\User;
use \App\Country;
use \App\Language;
use \Common\Generate;
use \Common\FileUpload;
use \Redirect;
use \Hash;

class ProfileController extends Controller
{

    //constructor class
    public function __construct()
    {
        $this->middleware('auth'); #check user is authenticated/login
    }

    public function showUserProfile(){
      $user = User::getUserProfile();
      $languages = Language::all();
      if($user['status'] != '200') return Render::errorPage($user['status']); //if error

      $countries = Country::getAll();

      return view('backend.user.profile')
          ->with('content_title', 'My Profile')
          ->with('languages', $languages)
          ->with('countries', $countries)
          ->with('user_info', $user['data']['user_info'])
          ->with('user_role', $user['data']['user_role']);
    }

    public function updateUserProfile(Request $request){
        try {
            $display_image = $request->file('display_image');
            $inputs = $request->all();
            $data = [];
            foreach ($inputs as $key => $value) {
                if ($key == 'orignal_image') {
                    continue;
                }
                $data[$key] = $value;
            }

            if ($display_image) {
                //Upload Image
                $uploaded_path = FileUpload::upload($display_image);
                $data['display_image'] = $uploaded_path;  //Dummy
            }else{
                $data['display_image'] = $inputs['orignal_image'];
            }
            User::where('id', $inputs['id'])->update($data);

            return Redirect::to('/crm/profile')
                    ->withMessage(Generate::success_message('Success', 'Profile Updated.') );
        } catch (Exception $e) {
          return Redirect::to('/crm/profile')
                  ->withMessage(Generate::error_message('Fail', 'Failed to update.') );
        }

    }

    public function processChangePassword(Request $request){
      try {
        $user_id = $request->get('user_id');
        $current_password = $request->get('current_password');
        $new_password = $request->get('new_password');
        $new_password_retype = $request->get('new_password_retype');
        if ($new_password != $new_password_retype) {
          return Redirect::to('/crm/profile')
                  ->withMessage(Generate::error_message('Fail', 'New password and retype password do not match.'));
        }
        $user = User::find($user_id);
        if (Hash::check($current_password, $user->password)) {
          $user->password = Hash::make($new_password);
          $user->save();
          return Redirect::to('/crm/profile')
                  ->withMessage(Generate::success_message('Success', 'Password Changed. Please login again.') );
        }
        return Redirect::to('/crm/profile')
                ->withMessage(Generate::error_message('Fail', 'Wrong current password') );

      } catch (Exception $e) {
        return Redirect::to('/crm/profile')
                ->withMessage(Generate::error_message('Fail', 'Failed to change password.') );
      }

    }
}
