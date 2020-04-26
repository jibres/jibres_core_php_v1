<?php
namespace content_pardakhtyar;


class controller
{
	public static function routing()
	{
		// $addr = '/home/reza/projects/jibres/includes/docs/pardakhtyar/sample file/BMJSSHAP98091915012.CT';
		// $xml = simplexml_load_string(file_get_contents($addr));
		// j($xml);
		// \dash\redirect::to_login();

		if(!\dash\permission::supervisor())
		{
			\dash\header::status(403);
		}

		\dash\permission::access('contentPardakhtyar');
	}
}
?>