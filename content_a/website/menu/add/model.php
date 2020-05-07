<?php
namespace content_a\website\menu\add;


class model
{
	public static function post()
	{

		$post =
		[
			'title'    => \dash\request::post('title'),
		];

		$theme_detail = \lib\app\website\menu\add::new_menu($post);


		if(\dash\engine\process::status())
		{
			if(isset($theme_detail['id']))
			{
				\dash\redirect::to(\dash\url::this(). '/menu/edit?id='. $theme_detail['id']);
			}
			else
			{
				\dash\redirect::to(\dash\url::this(). '/menu');
			}
		}
	}
}
?>
