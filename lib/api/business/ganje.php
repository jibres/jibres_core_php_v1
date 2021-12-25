<?php
namespace lib\api\business;


class ganje
{

	private static $apikey            = '0502755e684b813585ddda0f57ad3efa';

	private static $business_code     = '$jbj52';

	private static $ganje_last_update = '2021-12-25 00:00:00';


	private static function run($_path, $_method, $_param = null, $_body = null, $_option = [])
	{
		if(!\dash\url::isLocal())
		{
			return false;
		}

		$apikey        = self::$apikey;
		$business_code = self::$business_code;
		$url           = 'https://business.jibres.ir/'.$business_code.'/b1/';

		if(\dash\url::isLocal())
		{
			$apikey = '3ab3f2f67ad1f9f0be532fcb4f94950c';
			$business_code = '$jbjfs';
			$url = 'https://business.jibres.local/fa/'.$business_code.'/b1/';
		}

		$url .= $_path;

		// set headers
		$header   = [];
		$header[] = 'apikey: '. $apikey;

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

		$response  = curl_exec($ch);
		$CurlError = curl_error($ch);
		$getInfo   = curl_getinfo($ch);
		curl_close ($ch);



		if(!$response)
		{
			return false;
		}

		$result = json_decode($response, true);

		if(!is_array($result))
		{
			if(\dash\url::isLocal())
			{
				var_dump($response);exit;
			}
			return false;
		}

		return $result;

	}


	public static function fetch_product($_args)
	{
		$result = self::run('product/fetch','get', $_args);
		return $result;
	}


	public static function search(string $_string)
	{
		$result = self::run('product/fetch','get', ['q' => $_string]);
		return $result;
	}



	public static function detail($_id)
	{
		$result = self::run('product/detail','get', ['id' => $_id]);
		return $result;
	}


}
?>