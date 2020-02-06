<?php
namespace lib\nic\exec;


class run
{
	public static function send($_xml)
	{

		$_xml = trim($_xml);

		$data          = [];
		$data['xml']   = $_xml;
		$data['token'] = self::curl_token();

		// create a new cURL resource
		$ch = curl_init();

		//FALSE to stop cURL from verifying the peer's certificate
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

		//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

		curl_setopt($ch, CURLOPT_POST, false);
		//The URL to fetch.
		curl_setopt($ch, CURLOPT_URL,"http://7.7.7.25/nic/");
		//The full data to post in a HTTP "POST" operation.
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

		// grab URL and pass it to the browser
		$response = curl_exec($ch);

		if($response === false)	{
			// echo Errors
			echo 'Curl error: ' . curl_error($ch);
		}
		// close cURL resource, and free up system resources
		curl_close ($ch);

		return $response;
	}

	private static function curl_token()
	{
		return \dash\setting\nic::curl_token();
	}

	public static function token()
	{
		return \dash\setting\nic::token();
	}
}
?>