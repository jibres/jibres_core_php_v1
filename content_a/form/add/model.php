<?php
namespace content_a\form\add;

class model
{
	public static function post()
	{
		$post =
		[
			'title' => \dash\request::post('title'),
		];

		$result = \lib\app\form\form\add::add($post);

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::this(). '/item/add?id='. $result['id']);
		}
	}
}
?>