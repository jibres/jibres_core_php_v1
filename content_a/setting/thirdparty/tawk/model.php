<?php
namespace content_a\setting\thirdparty\tawk;


class model
{
	public static function post()
	{
		$post =
		[
			'addon_tawk'    => \dash\request::post('addon_tawk'),
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