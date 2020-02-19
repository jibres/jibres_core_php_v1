<?php
namespace content_v2;


class get
{
	public static function endpoint($_module = null)
	{
		$myEndpoint = '';
		if(\dash\url::domain() === 'jibres.ir')
		{
			$myEndpoint = 'https://api.jibres.ir/v2/';
		}
		elseif(\dash\url::domain() === 'jibres.local')
		{
			$myEndpoint = 'http://api.jibres.local/v2/';
		}
		else
		{
			$myEndpoint = 'https://api.jibres.com/v2/';
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