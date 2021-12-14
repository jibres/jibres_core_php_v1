<?php
namespace content_a\products\quick;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('id'))
		{
			\dash\permission::access('productAdd');
			\dash\data::addMode(true);
		}
		else
		{
			\dash\permission::access('ProductEdit');


			// check load product detail
			if(!\lib\app\product\load::one())
			{
				\dash\header::status(404);
			}
			\dash\data::editMode(true);
		}

	}
}
?>