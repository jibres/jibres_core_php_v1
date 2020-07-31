<?php
namespace lib\email;


class sendgrid
{

	private static $result_raw = [];


	private static function run($_body = null)
	{

		$header     = [];

		$post_field = [];

		if(is_array($_body))
		{
			$post_field = array_merge($post_field, $_body);
		}

		$post_field['broker_token'] = \dash\setting\sendgrid::broker_token();
		$post_field['apikey'] = \dash\setting\sendgrid::apikey();

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		// curl_setopt($ch, CURLOPT_URL, "https://tunnel.jibres.com/sendgrid/");
		curl_setopt($ch, CURLOPT_URL, "https://broker.local/email/sendgrid/");

		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_field));

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 90);
		curl_setopt($ch, CURLOPT_TIMEOUT, 90);

		$response = curl_exec($ch);
		$CurlError = curl_error($ch);

		curl_close ($ch);

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
			return false;
		}

		return $result;
	}



	public static function send($_args)
	{
		return self::run($_args);
	}
}
?>