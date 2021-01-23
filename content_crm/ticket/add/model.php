<?php
namespace content_crm\ticket\add;


class model
{
	public static function post()
	{

		$post =
		[
			'content' => \dash\request::post_raw('content'),
			'user_id' => \dash\request::post('user_id'),
			'title'   => \dash\request::post('title'),
		];

		$result = \dash\app\ticket\add::add_by_admin($post);

		if(\dash\engine\process::status())
		{
			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::this(). '/view?id='. $result['id']);
			}

			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>
