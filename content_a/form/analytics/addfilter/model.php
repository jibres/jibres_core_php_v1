<?php
namespace content_a\form\analytics\addfilter;


class model
{
	public static function post()
	{
		$post =
		[
			'title'     => \dash\request::post('title'),
		];

		$result = \lib\app\form\filter\add::add($post, \dash\request::get('id'));

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::that(). '/filter?id='. \dash\request::get('id'). '&fid='. $result['id']);
		}

	}

}
?>
