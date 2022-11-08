<?php
namespace lib\api\business;


class ganje
{
	/**
	 * Check ganje run in local or no
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	private static function local_ganje() : bool
	{
		if(\dash\url::isLocal())
		{
			if(gethostname() === 'reza-jibres')
			{
				return true;
			}

		}

		return false;
	}

	/**
	 * Gets the ganje store identifier.
	 *
	 * @return     float|int  The ganje store identifier.
	 */
	public static function ganje_business_id() : float
	{
		if(self::local_ganje())
		{
			return 1000003;
		}

		return 1000964;
	}


	/**
	 * Gets the ganje store code.
	 *
	 * @return    string  The ganje store code.
	 */
	public static function ganje_business_code() : string
	{
		if(self::local_ganje())
		{
			return '$jb2jw';
		}

		return '$jbj52';
	}


	/**
	 * Gets the ganje apikey.
	 *
	 * @return     string  The ganje apikey.
	 */
	public static function ganje_apikey() : string
	{
		if(self::local_ganje())
		{
			return '0502755e684b813585ddda0f57ad3efa';
		}

		return '0502755e684b813585ddda0f57ad3efa';
	}


	/**
	 * Gets the lastupdate.
	 *
	 * @param      bool        $_get_time  The get time
	 *
	 * @return     int|string  The lastupdate.
	 */
	public static function get_lastupdate($_get_time = false)
	{
		$ganje_last_update = '2021-12-27 00:00:00';

		if($_get_time)
		{
			return strtotime($ganje_last_update);
		}

		return $ganje_last_update;
	}



	/**
	 * Get API url
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function api_url() : string
	{
		if(self::local_ganje())
		{
			return 'https://business.jibres.local/fa/%s/b1/';
		}

		return 'https://business.jibres.ir/%s/b1/';
	}



	private static function run($_path, $_method, $_param = null, $_body = null, $_option = [])
	{
		// if(!self::local_ganje())
		// {
		// 	return false;
		// }

		$url = sprintf(self::api_url(), self::ganje_business_code());
		$url .= $_path;

		// set headers
		$header   = [];
		$header[] = 'apikey: '. self::ganje_apikey();

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


		if(!$response)
		{
			return false;
		}

		$result = json_decode($response, true);

		if(!is_array($result))
		{
			if(self::local_ganje())
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
		$result = self::run('product/fetch','get', ['q' => $_string, 'included_category' => true]);
		return $result;
	}



	public static function detail($_id)
	{
		$result = self::run('product/detail','get', ['id' => $_id]);
		return $result;
	}


	public static function barcode($_barcode)
	{
		$result = self::run('product/detail','get', ['barcode' => $_barcode]);
		return $result;
	}


}
?>