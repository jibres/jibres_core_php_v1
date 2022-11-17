<?php
namespace content_a\products\inventory;


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

	}


}
?>