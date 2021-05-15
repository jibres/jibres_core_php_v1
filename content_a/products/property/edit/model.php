<?php
namespace content_a\products\property\edit;


class model
{

	public static function post()
	{

		$id = \dash\request::get('id');

		\lib\app\product\property::edit_group(\dash\data::groupTitle(), \dash\request::post('group'), $id);


		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));

		}
	}
}
?>