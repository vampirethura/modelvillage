<?php

namespace Common;

/* < Import Scripts >----------------------------------------------------------------------*/

/* ----------------------------------------------------------------------------------------*/

class Generate{


	//----------------------------------------------------------------------------------------------------
	#Function to generate a random string by given length...
	public static function randomString($length, $charList = "")
	{
	    $retval = "";
	    if($charList == "") $charList = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	    $charLength = strlen($charList) - 1;
	    for($i=0; $i<$length; $i++) {
	        $retval .= $charList{rand(0,$charLength)};
	    }
	    return $retval;
	}


	//----------------------------------------------------------------------------------------------------
	#Function to generate the expiry date base on how many day ($type = D) or hour ($type = H) or minutes ($type = M)
	public static function expiry($type, $value)
	{
		$now = date("Y-m-d H:i:s");
		//adjust the expiry by hours
		if($type == 'H')
		{
			//$tz = new \DateTimeZone('Europe/London');

			$date = new \DateTime($now);
			$date->modify('+'.$value.' hours');

			return $date->format('Y-m-d H:i:s');
		}
		//adjust the expiry period by days
		else if($type == 'D')
		{
			//$tz = new \DateTimeZone('Europe/London');

			$date = new \DateTime($now);
			$date->modify('+'.$value.' day');

			return $date->format('Y-m-d H:i:s');
		}
		//adjust the expiry period by minutes
		else if($type == 'M')
		{
			$date - new \DateTime($now);
			$date = modify('+'.$value.' minute');

			return $date->format('Y-m-d H:i:s');
		}
	}

	//----------------------------------------------------------------------------------------------------
	//generate a return format
	public static function returnMsg($status, $msg='', $data=[])
	{
		$return_data = [];
		//messsage fails...
		if($status == 0)
		{
			(isset($message))? $message = 'Not Success' : $message = $msg;
		}

		//meesage success ...
		else if($status != 0)
		{
			(isset($message))? $message = 'Success! ': $message = $msg;
			$return_data = $data;
		}

		$return = [
			'status'=>$status,
			'message'=>$message,
			'data'=>$return_data
		];

		return $return;
	}


	//create notification params.
	public static function success_message($title, $body)
	{
		return ['title'=>$title, 'body'=>$body, 'type' => 'success'];
	}

	public static function error_message($title, $body)
	{
		return ['title'=>$title, 'body'=>$body, 'type' => 'error'];
	}


	//----------------------------------------------------------------------------------------------------
	# Generate the geo location (lat, long) using google geojson API
	public static function geoLocation ($address)
	{
	    $prepAddr = str_replace(' ','+',$address);
	    $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
	    $output= json_decode($geocode);
	    $latitude = $output->results[0]->geometry->location->lat;
	    $longitude = $output->results[0]->geometry->location->lng;

	    return [
	    	'long' => $latitude,
	    	'lat' => $longitude
	    ];
	}

	//----------------------------------------------------------------------------------------------------
	# decode the base64 image to jpg.
	public static function imageJpeg($base64_string, $output_file)
	{
		$path = '/assets/properties/images/'.$output_file;
	    $ifp = fopen(public_path().$path, "c+");
	    //return public_path();

	    $data = explode(',', $base64_string);

	    fwrite($ifp, base64_decode( $data[0]) );
	    fclose($ifp);

	    return [
	    	'path'=>$path,
	    	'filename'=>$output_file
	    ];
	}


	public static function currencyFormat($currency, $number)
	{
		if(!is_numeric($number)) return $number;
		setlocale(LC_MONETARY, 'en_US');
		$return = $currency.money_format('%(#6n', $number);
		return $return;
	}







}#end class
