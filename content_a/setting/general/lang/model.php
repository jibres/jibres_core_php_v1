<?php
namespace content_a\setting\general\lang;


class model
{
	public static function post()
	{
		$post =
		[
			'lang'    => \dash\request::post('lang'),
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