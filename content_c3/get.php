<?php
namespace content_c3;


class get
{
	public static function endpoint($_module = null)
	{
		$myEndpoint = '';
		if(\dash\url::domain() === 'jibres.ir')
		{
			$myEndpoint = 'https://core.jibres.ir/c3/';
		}
		elseif(\dash\url::domain() === 'jibres.local')
		{
			$myEndpoint = 'http://core.jibres.local/c3/';
		}
		else
		{
			$myEndpoint = 'https://core.jibres.com/c3/';
		}

		if($_module)
		{
			$myEndpoint .= $_module. '/';
		}

		return $myEndpoint;
	}
}
?>