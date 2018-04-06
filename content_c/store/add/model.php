<?php
namespace content_c\store\add;


class model extends \content_c\main\model
{
	public static function getPost()
	{
		$post         = [];
		$post['name'] = \dash\request::post('name');
		$post['slug'] = \dash\request::post('slug');
		$post['desc'] = \dash\request::post('desc');

  		return $post;
	}


	public function post_add()
	{
		\lib\app\store::add(self::getPost());

		if(\lib\engine\process::status())
		{
			\dash\redirect::to(\dash\url::here().'/store');
		}
	}
}
?>
