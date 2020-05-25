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
			"ip"      => $_ip,
			"country" => null,
			"state"   => null,
			"city"    => null,
			"isp"     => null,
			"flag"    => null,
		];
		// get from dbip
		$result['dbip']          = self::dbip($_ip);
		// get from ipgeolocation
		$result['ipgeolocation'] = self::ipgeolocation($_ip);


		// fill data
		if(isset($result['dbip']['countryCode']))
		{
			$result['flag'] = strtolower($result['dbip']['countryCode']);
		}
		if(isset($result['dbip']['countryName']))
		{
			$result['country'] = strtolower($result['dbip']['countryName']);
		}
		if(isset($result['dbip']['stateProv']))
		{
			$result['state'] = strtolower($result['dbip']['stateProv']);
		}
		if(isset($result['dbip']['city']))
		{
			$result['city'] = strtolower($result['dbip']['city']);
		}

		return $result;
	}


	public static function dbip($_ip)
	{
		// api url
		$url = 'http://api.db-ip.com/v2/free/'. $_ip;
		// get content
		$result = @file_get_contents($url);
		// try to decode
		$jsonResult = json_decode($result, true);
		// return
		return $jsonResult;
	}


	public static function ipgeolocation($_ip)
	{
		$apiKey = '0e1ef7d392f14429bad9ef9f95384570';
		// api url
		$url = 'https://api.ipgeolocation.io/ipgeo?apiKey='. $apiKey.'&ip='. $_ip;
		// get content
		$result = @file_get_contents($url);
		// try to decode
		$jsonResult = json_decode($result, true);
		// return
		return $jsonResult;
	}


}
?>