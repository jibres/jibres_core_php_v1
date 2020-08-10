<?php
namespace content_a\accounting\coding\add;

class model
{
	public static function post()
	{

		$post =
		[
			'parent'     => \dash\request::post('parent'),
			'title'      => \dash\request::post('title'),
			'code'       => \dash\request::post('code'),
			'type'       => \dash\request::get('type'),
			'nature'     => \dash\request::post('nature'),
			'detailable' => \dash\request::post('detailable'),
		];

		$result = \lib\app\tax\coding\add::add($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that());
		}
	}
}
?>
