<?php
namespace content_a\setting\thirdparty\crisp;


class model
{
	public static function post()
	{
		$post =
		[
			'addon_crisp' => \dash\request::post('addon_crisp'),
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