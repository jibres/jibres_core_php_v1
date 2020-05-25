<?php
namespace dash\utility;

/**
* get IP Location Data
*/
class ipLocation
{
	public static function get($_ip)
	{
		$result =
		[
			"country" => null,
			"state"   => null,
			"city"    => null,
			"isp"     => null,
			"flag"    => null,
		];
		// get from db_ip
		$result['db_ip'] = self::db_ip($_ip);


		// fill data
		if(isset($result['db_ip']['countryCode']))
		{
			$result['flag'] = strtolower($result['db_ip']['countryCode']);
		}
		if(isset($result['db_ip']['countryName']))
		{
			$result['country'] = strtolower($result['db_ip']['countryName']);
		}
		if(isset($result['db_ip']['stateProv']))
		{
			$result['state'] = strtolower($result['db_ip']['stateProv']);
		}
		if(isset($result['db_ip']['city']))
		{
			$result['city'] = strtolower($result['db_ip']['city']);
		}

		return $result;
	}


	public static function db_ip($_ip)
	{
		// api url
		$url = 'http://api.db-ip.com/v2/free/'. $_ip;
		// get content
		$result = file_get_contents($url);
		// try to decode
		$jsonResult = json_decode($result, true);
		// return
		return $jsonResult;
	}
}
?>