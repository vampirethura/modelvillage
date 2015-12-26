<?php
namespace Common;
use App\Customer;
use App\MobileSession;
use \Exception;

/**
 * Author : Min Thura
 * Created On : 18-Nov-2015
 * Version : 0.1.0
 */

class SessionUtil {
    public static function getCustomer($session_token){
      $session = MobileSession::where('session_id', $session_token)->first();
      if ($session) {
        $customer_id = $session->user_id;
        $customer = Customer::find($customer_id);
        return $customer;
      }
      throw new Exception("Invalid Session Token", 1);
    }
}
