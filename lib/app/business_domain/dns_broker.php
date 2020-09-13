<?php
namespace lib\app\business_domain;


class dns_broker
{

	public static function get($_doamin)
	{

		$header   = [];

		$post_field           = [];
		$post_field['domain'] = $_doamin;
		$post_field['broker_token'] = \dash\setting\checkdns::broker_token();

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_URL, "https://tunnel.jibres.com/checkdns/");

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
			\dash\notif::error(T_("Can not connect to Check DNS server!"));
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



	public static function local_get($_doamin)
	{
		try
		{
			$dns_record = @dns_get_record($_doamin, DNS_ALL);
			if($dns_record === false)
			{
				\dash\notif::error('can not get dns record. Result is false!');
				return false;
			}
			return $dns_record;
		}
		catch (\Exception $e)
		{
			\dash\notif::error("Can not get DNS record in Catch!");
			return null;
		}
	}

}
?>