<?php
namespace content_v3;


class get
{
	public static function endpoint($_module = null)
	{
		$myEndpoint = '';
		$store = '';
		if(\dash\url::store())
		{
			$store = '/'. \dash\url::store();
		}

		if(\dash\url::domain() === 'jibres.ir')
		{
			$myEndpoint = 'https://api.jibres.ir'. $store. '/v3/';
		}
		elseif(\dash\url::domain() === 'jibres.local')
		{
			$myEndpoint = 'https://api.jibres.local'. $store. '/v3/';
		}
		else
		{
			$myEndpoint = 'https://api.jibres.com'. $store. '/v3/';
		}

		if($_module)
		{
			$myEndpoint .= $_module;
		}

		return $myEndpoint;
	}

	public static function homepage($_module = null)
	{
		$myEndpoint = '';
		if(\dash\url::domain() === 'jibres.ir')
		{
			$myEndpoint = 'https://jibres.ir/';
		}
		elseif(\dash\url::domain() === 'jibres.local')
		{
			$myEndpoint = 'https://jibres.local/';
		}
		else
		{
			$myEndpoint = 'https://jibres.com/';
		}
		if($_module)
		{
			$myEndpoint .= $_module;
		}
		return $myEndpoint;
	}

}
?>