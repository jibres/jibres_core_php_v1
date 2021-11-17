<?php
namespace content_a\setting\thirdparty\goftino;


class model
{
	public static function post()
	{
		$post =
		[
			'addon_goftino' => \dash\request::post('addon_goftino'),
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