<?php
namespace content_r10;


class get
{
	public static function endpoint($_module = null)
	{
		$myEndpoint = '';
		if(\dash\url::domain() === 'jibres.ir')
		{
			$myEndpoint = 'https://core.jibres.ir/r10/';
		}
		elseif(\dash\url::domain() === 'jibres.local')
		{
			$myEndpoint = 'http://core.jibres.local/r10/';
		}
		else
		{
			$myEndpoint = 'https://core.jibres.com/r10/';
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