<?php
namespace lib\shaparak;

class exec
{
	private static $response_raw_detail = null;


	private static function go($_request, $_url)
	{
		// set headers
		$header   = [];

		// add json to haeder
		$header[] = 'Content-Type: application/json';
		$header[] = self::authHeader();

		// create a new cURL resource
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		//FALSE to stop cURL from verifying the peer's certificate
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

		//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2); // 20 time out of nic-broker
		curl_setopt($ch, CURLOPT_TIMEOUT, 2); // 20 time out of nic-broker

		curl_setopt($ch, CURLOPT_POST, false);
		// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, mb_strtoupper($_method));
		//The URL to fetch.
		curl_setopt($ch, CURLOPT_URL, $_url);

		$postfields = json_encode($_request, JSON_UNESCAPED_UNICODE);

		//The full data to post in a HTTP "POST" operation.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

		// grab URL and pass it to the browser
		$response = curl_exec($ch);

		$CurlError = curl_error($ch);

		self::$response_raw_detail =
		[
			'response' => $response,
			'code'     => curl_getinfo($ch, CURLINFO_HTTP_CODE),
			'header'   => curl_getinfo($ch, CURLINFO_HEADER_OUT),
			'info'     => curl_getinfo($ch),
		];

		curl_close ($ch);


		if($response && !is_string($response))
		{
			\dash\log::set('SHAPARAK:CurlErrorResponseIsNotString');
			\dash\notif::error(T_("Result of SHAPARAK server is not valid!"));
			return false;
		}

		if($response === false)
		{
			// echo Errors
			\dash\log::set('SHAPARAK:CurlError', ['message' => $CurlError]);
			\dash\notif::error(T_("Can not connect to shaparak server"));

			// \dash\notif::error(curl_error($ch));
			return false;
		}

		$first_char = substr($response, 0, 1);
		if($response && ($first_char === "{" || $first_char === "["))
		{
			$response = json_decode($response, true);
		}

		return $response;
	}


	private static function authHeader()
	{
		// set header of connection
		$auth   = base64_encode('926028'. ':'. '123456');
		$result = 'Authorization: Basic '. $auth;
		return $result;
	}


	private static function addr($_path = null)
	{
		$addr = 'http://192.168.250.100:9095/merchant/';

		if($_path === 'write')
		{
			$addr .= 'webService/writeExternalRequest/';
		}
		elseif($_path === 'read')
		{
			$addr .= 'webService/readRequestCartableWithFilter/';
		}
		elseif($_path === 'transfer')
		{
			$addr .= 'webService/transfer/request';
		}
		else
		{
			$addr .= $_path;
		}
		return $addr;
	}


	public static function run($_request, $_meta = [])
	{
		$url = self::addr('write');

		$save_log                = [];

		$save_log['user_id']     =  \dash\user::id();
		$save_log['datecreated'] =  date("Y-m-d H:i:s");
		$save_log['sendmd5']     =  md5(json_encode($_request, JSON_UNESCAPED_UNICODE));
		$save_log['send']        =  json_encode($_request, JSON_UNESCAPED_UNICODE);
		$save_log['url']         =  $url;
		$save_log['sendtime']    =  time();
		$save_log['related']     =  isset($meta['related']) ? $meta['related'] : null;
		$save_log['related_id']  =  isset($meta['related_id']) ? $meta['related_id'] : null;

		if(isset($_request['trackingNumberPsp']))
		{
			$save_log['trackingNumberPsp'] = $_request['trackingNumberPsp'];
		}

		// ************************** SEND DETAIL TO SHAPARAK ****************************/
		$response = self::go($_request, $url);


		if(isset($response['trackingNumber']))
		{
			$save_log['trackingNumber'] = $response['trackingNumber'];
		}

		if(isset($response['requestRejectionReasons']))
		{
			$save_log['requestRejectionReasons'] = $response['requestRejectionReasons'];
		}

		if(isset($response['success']))
		{
			$save_log['success'] = $response['success'];
		}

		$save_log['responsemd5']  =  md5(json_encode($response, JSON_UNESCAPED_UNICODE));
		$save_log['response']     =  json_encode($response, JSON_UNESCAPED_UNICODE);
		$save_log['responsetime'] =  time();

		$save_log['diff'] = time() - intval($save_log['sendtime']);

		\lib\db\shaparak\log\insert::new_record($save_log);

		var_dump($response, $_request);exit();
		return $response;
	}
}
?>