<?php
namespace dash\email;


class broker
{

	private static $result_raw = [];


	public static function transfer($_args, $_provider)
	{
		$brokerOpt = array_merge($_args, $_provider);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_URL, "https://tunnel.jibres.com/email/send/");
		// curl_setopt($ch, CURLOPT_URL, "http://localhost/brokers/email/send.php");

		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($brokerOpt));

		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);

		$response = curl_exec($ch);
		$CurlError = curl_error($ch);

		curl_close($ch);
		if(!$response)
		{
			\dash\notif::error(T_("Can not connect to Domain server!"));
			return false;
		}

		if(!is_string($response))
		{
			return false;
		}

		$result = json_decode($response, true);

		if(!is_array($result))
		{
			return $response;
		}

		return $result;
	}
}
?>