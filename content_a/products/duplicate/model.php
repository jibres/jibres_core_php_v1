<?php
namespace content_a\products\duplicate;


class model
{
	public static function post()
	{
		$title = \dash\request::post('title');

		$post =
		[
			'title' => $title,
		];

		$result = \lib\app\product\add::duplicate(\dash\request::get('id'), $post);

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::this(). '/edit?id='. $result['id']);
		}
		else
		{
			\dash\redirect::to(\dash\url::here());
		}
	}


}
?>