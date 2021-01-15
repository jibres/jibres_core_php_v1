<?php
namespace content_a\setting\addon\raychat;


class model
{
	public static function post()
	{
		$post =
		[
			'addon_raychat'    => \dash\request::post('addon_raychat'),
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