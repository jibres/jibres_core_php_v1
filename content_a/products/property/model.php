<?php
namespace content_a\products\property;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post                = [];
		$post['cat']         = \dash\request::post('cat');
		$post['key']         = \dash\request::post('key');
		$post['value']       = \dash\request::post('value');
		$post['outstanding'] = \dash\request::post('outstanding');

		\lib\app\product\property::add($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>