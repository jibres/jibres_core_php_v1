<?php
namespace content_i\category\add;

class model
{
	public static function post()
	{
		$post           = [];
		$post['title']  = \dash\request::post('title');
		$post['parent'] = \dash\request::post('parent');
		$post['in']     = \dash\request::post('in');
		$post['type']   = 'cat';

		\lib\app\category::add($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>