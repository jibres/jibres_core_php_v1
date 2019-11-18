<?php
namespace lib\pardakhtyar;

class sample
{
	public static function fill()
	{
		$mySample    = 1;
		$userRequest = \dash\request::get('sample');
		if($userRequest && is_numeric($userRequest))
		{
			$mySample = $userRequest;
		}

		$libAddr  = '\lib\pardakhtyar\sample\request'. $mySample;

		if(method_exists($libAddr, 'get'))
		{
			return $libAddr::get();
		}

		return false;
	}
}
?>