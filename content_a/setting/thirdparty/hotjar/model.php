<?php
namespace content_a\setting\thirdparty\hotjar;


class model
{
	public static function post()
	{
		$post =
		[
			'addon_hotjar' => \dash\request::post('addon_hotjar'),
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