<?php
namespace Common;

/**
 * Author : Min Thura
 * Created On : 18-Nov-2015
 * Version : 0.1.0
 */
 class PnS{
     private static $pns_android_app_name;
     private static $pns_ios_app_name;

     static function init(){
        $pns_configs = array_slice(\Config::get('laravel-push-notification::config'), 2);
        if (!$pns_configs) {
            $pns_configs = \Config::get('laravel-push-notification::config');
        }
        foreach ($pns_configs as $key => $pns_config) {
      		switch ($pns_config['service']) {
      			case 'apns':
      				self::$pns_ios_app_name = $key;
      				break;
      			case 'gcm':
      				self::$pns_android_app_name = $key;
      				break;
      		}
      	}
     }
    /*Send notification to one android device*/
     public static function sendPnsToAndroidDevice($device_token, $message, $data = null){
         try {
             if ($data && is_array($data)) {
                 $message = \PushNotification::Message($message, $data);
             }
             \PushNotification::app(self::$pns_android_app_name)
                             ->to($device_token)
                             ->send($message);
             return true;
         } catch (Exception $e) {
             Log::warning("PnS Exception => " . $e->getMessage());
             return false;
         }
     }

     /*Send notification to one iOS device*/
     public static function sendPnsToIOSDevice($device_token, $message, $data = null){
         try {
             if ($data && is_array($data)) {
                 $message = \PushNotification::Message($message, $data);
             }
             \PushNotification::app(self::$pns_ios_app_name)
                             ->to($device_token)
                             ->send($message);
             return true;
         } catch (Exception $e) {
             Log::warning("PnS Exception => " . $e->getMessage());
             return false;
         }
     }

     /*Send notification to many android devices*/
     public static function sendPnsToAndroidDevices($device_tokens, $message, $data = null){
        try {
            $a_devices_collection = array();
            foreach ($device_tokens as $device_token) {
                $a_devices_collection[] = \PushNotification::Device($device_token);
            }

            if($a_devices_collection){
               $a_devices_collection = \PushNotification::DeviceCollection($a_devices_collection);
               if ($data && is_array($data)) {
                   $message = \PushNotification::Message($message, $data);
               }               
               \PushNotification::app(self::$pns_android_app_name)
                               ->to($a_devices_collection)
                               ->send($message);
           }
           return true;
        } catch (Exception $e) {
            return false;
        }
     }

     /*Send notification to many iOS devices*/
     public static function sendPnsToIOSDevices($device_tokens, $message, $data = null){
        try {
            $i_devices_collection = array();
            foreach ($device_tokens as $device_token) {
                $i_devices_collection[] = \PushNotification::Device($device_token);
            }

            if($i_devices_collection){
               $i_devices_collection = \PushNotification::DeviceCollection($i_devices_collection);
               if ($data && is_array($data)) {
                   $message = \PushNotification::Message($message, $data);
               }
               \PushNotification::app(self::$pns_ios_app_name)
                               ->to($i_devices_collection)
                               ->send($message);
           }
           return true;
        } catch (Exception $e) {
            return false;
        }
     }
 }
 PnS::init();

?>
