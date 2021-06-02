<?php
namespace content_developers\libraries;


class controller
{
	public static function routing()
	{
		if(\dash\url::child() === 'jibres-domain-php-sdk')
		{
			\dash\redirect::to_external('https://github.com/jibres/jibres-domain-php-sdk');
		}
	}
}
?>