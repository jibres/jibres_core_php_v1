<?php
namespace content_a\setting\thirdparty\tidio;


class model
{
	public static function post()
	{
		$post =
		[
			'addon_tidio' => \dash\request::post('addon_tidio33'),
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