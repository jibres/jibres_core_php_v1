<?php
namespace content_a\products\property;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\product\property::remove(\dash\request::post('pid'), $id);
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

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