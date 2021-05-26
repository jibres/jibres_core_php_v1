<?php
namespace content_a\products\inventory;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');


		$post                  = [];



		\lib\app\product\edit::edit($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}




}
?>