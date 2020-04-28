<?php
namespace lib\shaparak;

class exec
{
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

		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20); // 20 time out of nic-broker
		curl_setopt($ch, CURLOPT_TIMEOUT, 20); // 20 time out of nic-broker

		curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, mb_strtoupper($_method));
		//The URL to fetch.
		curl_setopt($ch, CURLOPT_URL, $_url);


		//The full data to post in a HTTP "POST" operation.
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_request, JSON_UNESCAPED_UNICODE));

		// grab URL and pass it to the browser
		$response = curl_exec($ch);

		$CurlError = curl_error($ch);

		curl_close ($ch);

		if($response && !is_string($response))
		{
			\dash\log::set('SHAPARAK:CurlErrorResponseIsNotString');
			\dash\notif::error(T_("Result of SHAPARAK server is not valid!"));
			return false;
		}


		self::$response_raw = $response;

		if($response === false)
		{
			// echo Errors
			\dash\log::set('SHAPARAK:CurlError', ['message' => $CurlError]);
			\dash\notif::error(T_("Can not connect to shaparak server"));

			// \dash\notif::error(curl_error($ch));
			return false;
		}


		return $response;
	}


	private static function authHeader()
	{
		// if(!defined('shaparak_user') || !defined('shaparak_pass'))
		// {
		// 	\dash\code::jsonBoom('user pass is not defined!');
		// }
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


	public static function run($_request, $_type)
	{
		$url = self::addr('write');

		$response = self::go($_request, $url);

		return $response;
	}



	// public static function curl_old($_url, $_data = null, $_dataType = null, $_header = null, $_fullResponse = false)
	// {
	// 	$ch       = curl_init();
	// 	$customHeader = [];
	// 	curl_setopt($ch, CURLOPT_URL, $_url);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// 	// set timeout to connect
	// 	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	// 	curl_setopt($ch, CURLOPT_TIMEOUT, 2);

	// 	if($_data)
	// 	{
	// 		$postFields = null;
	// 		// fill based on input data
	// 		switch ($_dataType)
	// 		{
	// 			case 'json':
	// 				$postFields = json_encode($_data, JSON_UNESCAPED_UNICODE);
	// 				// add json to haeder
	// 				array_push($customHeader, 'Content-Type: application/json');
	// 				break;

	// 			case 'post':
	// 				$postFields = http_build_query($_data);
	// 				curl_setopt($ch, CURLOPT_POST, true);
	// 				break;

	// 			case 'form-data':
	// 			default:
	// 				// simple get
	// 				// do nothing
	// 				break;
	// 		}

	// 		// set postFields if exist
	// 		if($postFields)
	// 		{
	// 			curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// 		}
	// 	}

	// 	// combine custom headers
	// 	if(is_array($_header))
	// 	{
	// 		// merge 2 array
	// 		$customHeader = array_merge($customHeader, $_header);
	// 		// remove duplicates
	// 		$customHeader = array_unique($customHeader);
	// 	}
	// 	if(is_array($customHeader) && count($customHeader) > 0 )
	// 	{
	// 		// set cusotm header
	// 		curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeader);
	// 	}

	// 	if(defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4'))
	// 	{
 // 			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
	// 	}

	// 	// execute curl and get response
	// 	$curlResult  = curl_exec($ch);

	// 	if($curlResult === false)
	// 	{
	// 		// we have error
	// 		$finalResult = curl_error($ch);
	// 	}
	// 	else
	// 	{
	// 		$finalResult = $curlResult;
	// 	}

	// 	// get first char of result
	// 	$resultFirstChar = substr($finalResult, 0, 1);
	// 	if($finalResult && ($resultFirstChar === "{" || $resultFirstChar === "["))
	// 	{
	// 		$finalResult = json_decode($finalResult, true);
	// 	}

	// 	if($_fullResponse)
	// 	{
	// 		$finalResult =
	// 		[
	// 			'response' => $finalResult,
	// 			'code'     => curl_getinfo($ch, CURLINFO_HTTP_CODE),
	// 			'header'   => curl_getinfo($ch, CURLINFO_HEADER_OUT),
	// 			'info'     => curl_getinfo($ch),
	// 		];
	// 	}
	// 	// close connection
	// 	curl_close($ch);

	// 	// return final result
	// 	return $finalResult;
	// }
}
?>