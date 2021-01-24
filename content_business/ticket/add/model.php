<?php
namespace content_business\ticket\add;

class model
{
	public static function post()
	{
		$post =
		[
			'title'   => \dash\request::post('title'),
			'content' => \dash\request::post('content'),
		];

		$result = \dash\app\ticket\add::add($post);

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::this(). '/view?id='. $result['id']);
		}
	}
}
?>