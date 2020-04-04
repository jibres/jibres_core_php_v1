<?php
namespace content_a\setting\googleanalytics;


class model
{
	public static function post()
	{
		$post =
		[
			'google_analytics'    => \dash\request::post('google_analytics'),
		];

		\lib\app\store\edit::selfedit($post);

		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}


}
?>