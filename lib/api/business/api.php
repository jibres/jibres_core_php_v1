<?php
namespace lib\api\business;

/**
 * Business API
 * This class describes a bpi.
 */
class api
{

	private static function run($_business_id, $_path, $_method, $_param = null, $_body = null, $_option = [])
	{
		// if(!\dash\user::login())
		// {
		// 	return false;
		// }

		// if(\dash\engine\store::inStore())
		// {
		// 	\dash\notif::error_once(T_("This method works only in jibres mode"));
		// 	return false;
		// }

		$apikey = \dash\setting\whisper::say('jibres_api', 'bpi_token');

		$apikey = \dash\utility::hasher($apikey);

		$url = \dash\url::jibres_subdomain('business');
		// $url .= \dash\language::current(). '/';
		$url .= \dash\store_coding::encode($_business_id). '/';
		$url .= 'b1/business/';
		$url .= $_path;

		// set headers
		$header   = [];
		$header[] = 'Authorization: '. $apikey;
		$header[] = 'x-busisness: '. \lib\store::code();
		$header[] = 'x-buser: '. \dash\user::code();
		$header[] = 'x-juser: '. \dash\coding::encode(\dash\user::jibres_user());

		if($_body)
		{
			$header[] = 'Accept: application/json';
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
			$_body = json_encode($_body);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $_body);
		}


		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		if(\dash\url::isLocal())
		{
			curl_setopt($ch, CURLOPT_PROXY, '');
		}

		$response  = curl_exec($ch);
		$CurlError = curl_error($ch);
		$getInfo   = curl_getinfo($ch);
		curl_close ($ch);

		$log =
		[
			'header'          => $header,
			'url'             => $url,
			'func_get_args'   => func_get_args(),
			'response'        => $response,
			'response_decode' => json_decode($response, true),
			'CurlError'       => $CurlError,
			'Info'            => $getInfo,
		];

		// \dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'arvan_cdn_api.log', 'arvand_api');


		if(!$response)
		{
			if($CurlError)
			{
				\dash\log::to_supervisor('#BusinessAPI #CURL_Error: '. $CurlError);
				\dash\log::oops();
			}
			return false;
		}

		if(!is_string($response))
		{
			\dash\notif::error('Jibres: Result is invalid!');
			return false;
		}

		$result = json_decode($response, true);

		if(!is_array($result))
		{
			if(\dash\url::isLocal())
			{
				var_dump($log);exit;
			}

			\dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'business_api.log', 'business');

			\dash\notif::error('Jibres: Can not parse JSON!');
			return false;
		}

		return $result;

	}

	public static function sync_required($_business_id)
	{
		$result = self::run($_business_id, 'plugin','post', null, ['sync_required' => 'yes']);
		return $result;
	}


	public static function plan_sync_required($_business_id)
	{
		$result = self::run($_business_id, 'plan','post', null, ['sync_required' => 'yes']);
		return $result;
	}


	public static function sms_sync_required($_business_id)
	{
		$result = self::run($_business_id, 'sms','post', null, ['sync_required' => 'yes']);
		return $result;
	}


	public static function set_sms_delivery($_business_id, $_args)
    {
        $result = self::run($_business_id, 'sms/delivery','post', null, $_args);
        return $result;
    }



    public static function set_instagram_detail($_business_id, $_args)
	{
		$result = self::run($_business_id, 'instagram/detail','post', null, $_args);
		return $result;
	}



	public static function enter_verification_sms_receive($_business_id, $_args)
	{
		$result = self::run($_business_id, 'verification','post', null, $_args);
		return $result;
	}



}
?>