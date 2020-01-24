<?php
namespace content_core\v3;


class get
{
	public static function endpoint($_module)
	{
		$myEndpoint = ''
		if(\dash\url::domain() === 'jibres.ir')
		{
			$myEndpoint = 'https://core.jibres.ir/v3';
		}
		else
		{
			$myEndpoint = 'https://core.jibres.com/v3';
		}
		if($_module)
		{
			$myEndpoint .= '/'. $_module;
		}
		\dash\data::endpoint($myEndpoint);
	}
}
?>