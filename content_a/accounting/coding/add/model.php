<?php
namespace content_a\accounting\coding\add;

class model
{
	public static function post()
	{
		$post =
		[
			'title' => \dash\request::post('title'),
			'code' => \dash\request::post('code'),
			'type' => \dash\request::post('type'),
		];

		$result = \lib\app\tax\coding\add::add($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that());
		}
	}
}
?>
