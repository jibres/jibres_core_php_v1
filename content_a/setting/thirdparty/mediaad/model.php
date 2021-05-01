<?php
namespace content_a\setting\thirdparty\mediaad;


class model
{
	public static function post()
	{
		$post =
		[
			'addon_mediaad' => \dash\request::post('addon_mediaad'),
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