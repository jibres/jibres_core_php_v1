<?php
namespace content_a\products\shipping;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post                = [];

		$post['weight'] = \dash\request::post('weight');
		$post['preparationtime'] = \dash\request::post('preparationtime');

		\lib\app\product\edit::edit($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}




}
?>