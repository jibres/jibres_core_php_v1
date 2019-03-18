<?php
namespace content_i\category\edit;


class model
{
	public static function post()
	{

		$post                  = [];
		$post['title']  = \dash\request::post('title');
		$post['parent'] = \dash\request::post('parent');
		$post['in']     = \dash\request::post('in');
		$post['type']   = 'cat';


		\lib\app\category::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}

	}
}
?>