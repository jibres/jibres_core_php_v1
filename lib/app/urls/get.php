<?php
namespace lib\app\urls;


class get
{

	private static $cache = [];


	public static function url_id()
	{
		if(\dash\temp::get('force_stop_visitor'))
		{
			return null;
		}

		$url = \dash\url::pwd();

		return self::url_db($url);


	}


	public static function referer_id()
	{
		if(\dash\temp::get('force_stop_visitor'))
		{
			return null;
		}

		$referer = null;
		if(\dash\server::referer())
		{
			$referer = \dash\server::referer();
		}

		if(!$referer)
		{
			return null;
		}

		if($referer === \dash\url::pwd())
		{
			return self::url_id();
		}

		if($referer === \dash\url::site() . '/')
		{
			return null;
		}

		return self::url_db($referer, true);
	}


	private static function url_db($_url, $_referer = false)
	{

		$urlMd5 = md5($_url);

		if(isset(self::$cache[$urlMd5]))
		{
			return self::$cache[$urlMd5];
		}

		$result = \dash\pdo\query_template::get_where('urls', ['urlmd5' => $urlMd5, 'limit' => 1]);

		if(isset($result['id']))
		{
			self::$cache[$urlMd5] = $result['id'];

			return floatval($result['id']);
		}
		else
		{
			$analyzeUrl = \dash\validate\url::parseUrl($_url);

			if(!$analyzeUrl)
			{
				return null;
			}

			$insert_url = [];

			$insert_url['urlmd5']      = $urlMd5;
			$insert_url['domain']      = a($analyzeUrl, 'domain');
			$insert_url['subdomain']   = a($analyzeUrl, 'subdomain');
			$insert_url['path']        = a($analyzeUrl, 'path');
			$insert_url['query']       = a($analyzeUrl, 'query');
			$insert_url['pwd']         = $_url;
			$insert_url['datecreated'] = date("Y-m-d H:i:s");

			$newId = \dash\pdo\query_template::insert('urls', $insert_url);

			self::$cache[$urlMd5] = $newId;

			return $newId;
		}
	}


}