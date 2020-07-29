<?php
namespace lib\arvancloud;


class api
{

	private static $result_raw = [];


	private static function run($_path, $_method, $_param = null, $_body = null, $_option = [])
	{
		// if(\dash\url::isLocal())
		// {
		// 	return false;
		// }

		$apikey = \dash\setting\dns_server::apikey();

		$language = \dash\language::current() === 'fa' ? 'fa' : 'en';

		$master_url = "https://napi.arvancloud.com/cdn/4.0/domains/%s";

		$url = sprintf($master_url, $_path);

		$json = false;
		if(isset($_option['json']) && $_option['json'])
		{
			$json = true;
		}
		// set headers
		$header   = [];
		$header[] = 'Accept: application/json';
		$header[] = 'Authorization: '. $apikey;
		$header[] = 'Accept-Language: '. $language;

		if($json)
		{
			$header[] = 'Content-Type: application/json';
		}


		if($_param && is_array($_param))
		{
			$url .= '?'. http_build_query($_param);
		}

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, mb_strtoupper($_method));
		curl_setopt($ch, CURLOPT_URL, $url);

		if($_body && is_array($_body))
		{
			if($json)
			{
				$_body = json_encode($_body, JSON_UNESCAPED_UNICODE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $_body);
			}
			else
			{
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_body));
			}
		}


		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);

		$response  = curl_exec($ch);
		$CurlError = curl_error($ch);
		$getInfo   = curl_getinfo($ch);
		curl_close ($ch);

		$log =
		[
			'url'             => $url,
			'func_get_args'   => func_get_args(),
			'response'        => $response,
			'response_decode' => json_decode($response, true),
			'CurlError'       => $CurlError,
		];

		\dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'arvan_cdn_api.log', 'arvand_api');

		if(!$response)
		{
			\dash\notif::error(T_("Can not connect to Domain server!"));

			if($CurlError)
			{
				\dash\notif::error(' CURL Error: '. $CurlError);
			}
			return false;
		}

		if(!is_string($response))
		{
			\dash\notif::error('Jibres: Result curl is not string!');
			return false;
		}

		$result = json_decode($response, true);

		if(!is_array($result))
		{
			\dash\notif::error('Jibres: Can not parse JSON!');
			return false;
		}

		return $result;

	}


	private static function make_error($_code, $_msg)
	{
		\dash\notif::error(T_($_msg), ['code' => $_code]);
	}


	// ---------------------------------------- DOMAIN ---------------------------------------- //
	public static function domain_list()
	{
		return self::run('', 'get');
	}


	public static function get_domain($_domain)
	{
		return self::run($_domain, 'get');
	}


	public static function add_domain($_domain)
	{
		return self::run('dns-service', 'post', null, ['domain' => $_domain]);
	}


	public static function get_ns_key($_domain)
	{
		return self::run($_domain. '/dns-service/ns-keys', 'get');
	}


	public static function get_dns_record($_domain)
	{
		return self::run($_domain. '/dns-records', 'get');
	}


	public static function check_dns_record($_domain)
	{
		return self::run($_domain. '/dns-service/check-ns', 'put', null, []);
	}



	public static function add_dns_record($_domain, $_args)
	{
		return self::run($_domain. '/dns-records', 'post', null, $_args);
	}


	public static function update_dns_record($_domain, $_args, $_id)
	{
		return self::run($_domain. '/dns-records/'. $_id, 'put', null, $_args);
	}


	public static function get_arvan_request($_domain)
	{
		return self::run($_domain. '/https', 'get');
	}



	public static function set_arvan_request($_domain, $_args)
	{
		return self::run($_domain. '/https/certificate/arvan/request', 'post', null, $_args);
	}







}
?>