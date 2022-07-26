<?php
namespace content_site\page\duplicate;


class model
{
	public static function post()
	{


		$page_id = \dash\request::get('id');

		$args =
		[
			'title' => \dash\request::post('title'),
		];

		$new_page_id = \content_site\duplicate::page($page_id, $args);

		if($new_page_id)
		{
			\dash\redirect::to(\dash\url::this(). '?id='. $new_page_id);
		}

	}



}
