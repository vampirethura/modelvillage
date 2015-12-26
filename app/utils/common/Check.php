<?php
namespace Common;

class Check
{
	public static function validSession()
	{
		$user_session = \Session::get('user');
		if(isset($user_session)) return true;
		return false;
	}

}
