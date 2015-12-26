<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use App\MobileSession;
use App\Customer;
use \Session;
use \Mail;
use \Input;
use \Response;
use \Hash;
use Common\Generate;
use Common\SessionUtil;
use \Exception;
class LoginApiController extends Controller
{
  public function login(Request $request)
  {
      try {
        $email = Input::get('email');
        $password = Input::get('password');
        $device_token = Input::get('device_token', 'null');
        $platform = Input::get('platform', 'A');
        $customer = Customer::where('email', $email)->first();
        if ($customer) {
          if ($customer->status == 0) {
            return Response::json(['status' => 2, 'message' => 'Account is inactive.']);
          }
          if(Hash::check($password, $customer->password)){
            //Login Success
            //Update platform and device token.
            $customer->update(['platform' => $platform, 'device_token' => $device_token]);
            //Delete old sessions
            $old_session = MobileSession::where('user_id', $customer->id)->first();
            //Save new session
            Session::regenerate();
            $session_token = Session::getId();
            $current_datetime = date('Y-m-d H:i:s');
            $session_data = [
              'user_id' => $customer->id,
              'session_id' => $session_token,
              'created_at' => $current_datetime,
              'updated_at' => $current_datetime
            ];
            if ($old_session) {
              MobileSession::find($old_session->id)->update($session_data);
            }else{
              MobileSession::create($session_data);
            }

            //Respond Success
            $data = [
              'status' => 1,
              'session_token' => $session_token
            ];
            return Response::json($data);
          }
          return Response::json(['status' => 2, 'message' => 'Incorrect Password.'], 401);
        }
        return Response::json(['status' => 2, 'message' => 'Incorrect Email.'], 401);
      } catch (Exception $e) {
        return Response::json(['status' => 0, 'message' => 'Something went wrong.'], 500);
      }
  }
}
