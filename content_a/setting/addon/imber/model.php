<?php
namespace content_a\setting\addon\imber;


class model
{
	public static function post()
	{
		$post =
		[
			'addon_imber'    => \dash\request::post('addon_imber'),
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