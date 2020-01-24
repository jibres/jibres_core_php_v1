<?php
namespace content_core\v3;


class get
{
	public static function endpoint($_module = null)
	{
		$myEndpoint = '';
		if(\dash\url::domain() === 'jibres.ir')
		{
			$myEndpoint = 'https://core.jibres.ir/v3/';
		}
		elseif(\dash\url::domain() === 'jibres.local')
		{
			$myEndpoint = 'http://core.jibres.local/v3/';
		}
		else
		{
			$myEndpoint = 'https://core.jibres.com/v3/';
		}

		if($_module)
		{
			$myEndpoint .= $_module. '/';
		}

		return $myEndpoint;
	}
}
?>