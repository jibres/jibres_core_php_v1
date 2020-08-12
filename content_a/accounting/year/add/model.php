<?php
namespace content_a\accounting\year\add;

class model
{
	public static function post()
	{
		$post =
		[
			'title'     => \dash\request::post('title'),
			'startdate' => \dash\request::post('startdate'),
			'enddate'   => \dash\request::post('enddate'),
		];

		$result = \lib\app\tax\year\add::add($post);

		if(\dash\engine\process::status() && isset($result['id']))
		{
			\dash\redirect::to(\dash\url::that(). '/edit?id='. $result['id']);
		}
	}
}
?>
