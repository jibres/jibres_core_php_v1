<?php
namespace lib\app\business_domain;


class dns_broker
{

	public static function get($_doamin, $_type = 'DNS_NS')
	{

		$header   = [];

		$post_field                 = [];
		$post_field['domain']       = $_doamin;
		$post_field['type']         = $_type;
		$post_field['broker_token'] = \dash\setting\tunnel_token::get('checkdns');


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
			$dns_record = @dns_get_record($_doamin, DNS_TXT);
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



	public static function dig($_doamin, $_type)
	{
		$cmd = 'dig txt '. $_doamin;

		$result = shell_exec($cmd);

		return self::dig_result($_doamin, $result, 'TXT');
	}


	public static function dig_result($_doamin, $_text, $_type)
	{
		$explode = explode(PHP_EOL, $_text);

		$record = [];

		foreach ($explode as $key => $line)
		{
			if(substr($line, 0, mb_strlen($_doamin) + 1) === $_doamin. '.')
			{
				$line = explode(' ', preg_replace('/\s+/', ' ', $line));

				if(a($line, 3) !== $_type)
				{
					continue;
				}

				if($_type === 'TXT')
				{
					$temp = $line;
					unset($temp[0]);
					unset($temp[1]);
					unset($temp[2]);
					unset($temp[3]);
					$temp = trim(implode(' ', $temp), '"');
					$record[] = $temp;
				}
				else
				{
					$record[] = $line;
				}
			}
		}

		return $record;
	}

}
?>