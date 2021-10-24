<?php
namespace content_a\discount\duplicate;


class model
{
	public static function post()
	{
		$post =
		[
			'code'             => \dash\request::post('code'),
		];


		$result = \lib\app\discount\add::duplicate($post, \dash\request::get('id'));

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::this(). '/edit?id='. $result['id']);
		}


		\dash\notif::complete();


	}
}
?>