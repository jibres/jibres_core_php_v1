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
			"ip"        => $_ip,
			"country"   => null,
			"state"     => null,
			"city"      => null,
			"isp"       => null,
			"flag"      => null,
			"latitude"  => null,
			"longitude" => null,

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
		if(!$result['flag'] && isset($result['ipgeolocation']['country_code2']))
		{
			$result['flag'] = strtolower($result['ipgeolocation']['country_code2']);
		}

		if(isset($result['dbip']['countryName']))
		{
			$result['country'] = strtolower($result['dbip']['countryName']);
		}
		if(!$result['country'] && isset($result['ipgeolocation']['country_name']))
		{
			$result['country'] = strtolower($result['ipgeolocation']['country_name']);
		}

		if(isset($result['dbip']['stateProv']))
		{
			$result['state'] = strtolower($result['dbip']['stateProv']);
		}
		if(!$result['state'] && isset($result['ipgeolocation']['state_prov']))
		{
			$result['state'] = strtolower($result['ipgeolocation']['state_prov']);
		}

		if(isset($result['dbip']['city']))
		{
			$result['city'] = strtolower($result['dbip']['city']);
		}
		if(!$result['city'] && isset($result['ipgeolocation']['city']))
		{
			$result['city'] = strtolower($result['ipgeolocation']['city']);
		}

		if(isset($result['ipgeolocation']['latitude']))
		{
			$result['latitude'] = strtolower($result['ipgeolocation']['latitude']);
		}
		if(isset($result['ipgeolocation']['longitude']))
		{
			$result['longitude'] = strtolower($result['ipgeolocation']['longitude']);
		}
		if(isset($result['ipgeolocation']['isp']))
		{
			$result['isp'] = strtolower($result['ipgeolocation']['isp']);
		}
		return $result;
	}


	public static function dbip($_ip)
	{
		// api url
		$url = 'http://api.db-ip.com/v2/free/'. $_ip;
		// get content
		$result = self::curl_get_contents($url);
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
		$result = self::curl_get_contents($url);
		// try to decode
		$jsonResult = json_decode($result, true);
		// remove flag url!
		if(isset($jsonResult['country_flag']))
		{
			unset($jsonResult['country_flag']);
		}
		// return
		return $jsonResult;
	}



	private static function curl_get_contents($url)
	{
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($curl, CURLOPT_TIMEOUT, 5);
		$data = curl_exec($curl);
		curl_close($curl);
		return $data;
	}

}
?>