<?php
namespace lib\api\file;

class api
{

	public static function url()
	{
		$url = 'https://tunnel.jibres.com/file/';
		if(\dash\url::isLocal())
		{
			// $url = 'https://broker.local/file/';
		}

		return $url;
	}


	/**
	 * Run
	 * Connect to facebook
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	private static function run($_url)
	{
		// send all detail to broker
		$body =
		[
			'broker_token' => \dash\setting\tunnel_token::get('file'),
			'xurl'         => $_url,
		];

		$ch = curl_init();

		// curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_URL, self::url());


		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
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
			'func_get_args'   => func_get_args(),
			'response'        => $response,
			'response_decode' => json_decode($response, true),
			'CurlError'       => $CurlError,
		];

		\dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'file.log', 'file');

		if(!$response)
		{
			\dash\notif::error(T_("Can not connect to file server!"));

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


	public static function download($_file_path)
	{
		$result = self::run($_file_path);

		if(isset($result['folder']) && $result['file'])
		{
			$path = self::url(). $result['folder']. '/'. $result['file'];
			return $path;
		}

		return null;


	}
}
?>