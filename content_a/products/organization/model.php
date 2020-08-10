<?php
namespace content_a\products\organization;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post                = [];

		$post['company'] = \dash\request::post('company');
		$post['unit']    = \dash\request::post('unit') ? \dash\request::post('unit') : null;
		$post['type']    = \dash\request::post('type');

		\lib\app\product\edit::edit($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}




}
?>