<?php
namespace content_a\setting\fund;


class model
{
	public static function post()
	{

		$post          = [];

		$post['title'] = \dash\request::post('title');
		$post['desc']  = \dash\request::post('desc');

		$result = \lib\app\fund\add::add($post);

		if($result)
		{
			\dash\redirect::pwd();
		}

	}
}
?>