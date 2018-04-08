<?php
namespace content_c\store\add;


class model
{
	public static function post()
	{
		\lib\app\store::add(self::getPost());

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::here().'/store');
		}
	}


	public static function getPost()
	{
		$post         = [];
		$post['name'] = \dash\request::post('name');
		$post['slug'] = \dash\request::post('slug');
		$post['desc'] = \dash\request::post('desc');

  		return $post;
	}
}
?>
