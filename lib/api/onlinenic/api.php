<?php
namespace lib\api\onlinenic;


class api
{

	private static $result_raw = [];


	private static function run($_path, $_body = null)
	{

		$user     = \dash\setting\onlinenic::user();
		$password = \dash\setting\onlinenic::password();
		$apikey   = \dash\setting\onlinenic::apikey();

		$time     = time();

		$token    = $user. md5($password). $time. $_path;
		$token    = md5($token);

		// $master_url = "https://ote.onlinenic.com";
		if(\dash\url::isLocal())
		{
			// test api
			$master_url = "https://ote.onlinenic.com/api4/domain/index.php?command=%s";
		}
		else
		{
			// live api
			$master_url = "https://api.onlinenic.com/api4/domain/index.php?command=%s";
		}

		// set headers
		$header   = [];


		$url = sprintf($master_url, $_path);

		$post_field              = [];
		$post_field['user']      = $user;
		$post_field['timestamp'] = $time;
		$post_field['apikey']    = $apikey;
		$post_field['token']     = $token;


		// save log
		$insert_log =
		[
			'type'          => $_path,
			'user_id'       => \dash\user::id(),
			'send'          => json_encode($_body, JSON_UNESCAPED_UNICODE),
			'datesend'      => date("Y-m-d H:i:s"),
			'domain'        => isset($_body['domain']) ? $_body['domain'] : null,
			'ip'            => \dash\server::iplong(),
			'gateway'		=> \dash\temp::get('run:by:system') ? 'system' : 'user',
		];


		if(is_array($_body))
		{
			$post_field = array_merge($post_field, $_body);
		}

		$post_field['broker_token'] = \dash\setting\onlinenic::broker_token();
		$post_field['api_url']      = $url;


		$ch = curl_init();

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_URL, "https://tunnel.jibres.com/onlinenic/");

		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_field));

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

		$timeout = 90;
		// in local have timeout error for connection!
		if(\dash\url::isLocal())
		{
			$timeout = 5;
		}

		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

		$response = curl_exec($ch);
		$CurlError = curl_error($ch);

		curl_close ($ch);

		$insert_log['dateresponse'] = date("Y-m-d H:i:s");

		if(!$response)
		{
			\dash\notif::error(T_("Can not connect to Domain server!"));

			$insert_log['result'] = 'Jibres: Result curl is false!';

			if($CurlError)
			{
				$insert_log['result'] .= ' CURL Error: '. $CurlError;
			}

			\lib\db\onlinenic_log\insert::new_record($insert_log);
			return false;
		}

		if(!is_string($response))
		{
			$insert_log['result'] = 'Jibres: Result curl is not string!';
			\lib\db\onlinenic_log\insert::new_record($insert_log);
			return false;
		}


		$insert_log['response'] = addslashes($response);

		$result = json_decode($response, true);

		if(!is_array($result))
		{
			$insert_log['result'] = 'Jibres: Can not parse JSON!';
			\lib\db\onlinenic_log\insert::new_record($insert_log);
			return false;
		}

		if(isset($result['code']) && is_numeric($result['code']))
		{
			$insert_log['result_code'] = floatval($result['code']);
		}

		$log_id = \lib\db\onlinenic_log\insert::new_record($insert_log);
		\dash\temp::set('ONLINENIC-last-log-id', $log_id);

		if(isset($result['msg']) && isset($result['code']) && intval($result['code']) !== 1000)
		{
			self::make_error($result['code'], $result['msg']);
		}


		return $result;

	}


	private static function make_error($_code, $_msg)
	{
		\dash\notif::error(T_($_msg), ['code' => $_code]);
	}


	private static function never_run_this_function_just_for_T_()
	{
		$msg = T_("Operation failed.The domain does not exist or does not belong to you.");
		$msg = T_("Failed to update domain status.clientTransferProhibited status not found");
	}



	// ---------------------------------------- DOMAIN ---------------------------------------- //

	public static function check_domain($_domin, $_op = null)
	{
		$op = null;

		switch ($_op)
		{
			case 'register':
				$op = 1;
				break;

			case 'transfer':
				$op = 2;
				break;

			case 'renew':
				$op = 3;
				break;
		}

		$result = self::run('checkDomain', ['domain' => $_domin, 'op' => $op]);
		return $result;
	}


	public static function register_domain($_args)
	{
		$result = self::run('registerDomain', $_args);
		return $result;
	}


	public static function renew_domain($_args)
	{
		$result = self::run('renewDomain', $_args);
		return $result;
	}


	public static function transfer_domain($_args)
	{
		$result = self::run('transferDomain', $_args);
		return $result;
	}


	public static function info_domain($_domain)
	{
		$args           = [];
		$args['domain'] = $_domain;
		$result = self::run('infoDomain', $args);
		return $result;
	}




	public static function create_contact_id($_args)
	{
		$result = self::run('createContact', $_args);
		return $result;
	}


	public static function update_domain_dns($_args)
	{
		$result = self::run('updateDomainDns', $_args);
		return $result;
	}

	public static function lock($_domain)
	{
		$args           = [];
		$args['domain'] = $_domain;
		$args['ctp']    = 'Y';
		$result = self::run('updateDomainStatus', $args);
		return $result;
	}


	public static function unlock($_domain)
	{
		$args           = [];
		$args['domain'] = $_domain;
		$args['ctp']    = 'N';
		$result = self::run('updateDomainStatus', $args);
		return $result;
	}



	public static function get_auth_code($_domain)
	{
		$args           = [];
		$args['domain'] = $_domain;
		$result = self::run('getAuthCode', $args);
		return $result;
	}






}
?>