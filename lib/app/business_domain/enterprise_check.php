<?php
namespace lib\app\business_domain;


class enterprise_check
{

	public static function is_connected_to_jibres($_doamin)
	{


		$ch = curl_init();

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_URL, "https://". $_doamin);



		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_HEADER, 1);

		$response = curl_exec($ch);
		$CurlError = curl_error($ch);
		$getInfo   = curl_getinfo($ch);

		curl_close ($ch);

		if(strpos($response, 'x-powered-by: Jibres') !== false)
		{
			return addslashes($response);
			return true;
		}
		else
		{
			return false;
		}

		return $result;
	}





}
?>