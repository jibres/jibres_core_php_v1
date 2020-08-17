<?php
namespace content_a\accounting\doc\duplicate;


class model
{
	public static function post()
	{
		$number = \dash\request::post('number');

		$post =
		[
			'number' => $number,
		];

		$result = \lib\app\tax\doc\add::duplicate(\dash\request::get('id'), $post);

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::that(). '/edit?id='. $result['id']);
		}

	}


}
?>