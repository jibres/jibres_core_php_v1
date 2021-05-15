<?php
namespace content_a\products\property\edit;


class controller
{
	public static function routing()
	{
		\dash\permission::access('ProductEdit');

		// check load product detail
		if(!\lib\app\product\load::one())
		{
			\dash\header::status(404);
		}


		$back = \dash\url::this(). '/property?id='. \dash\request::get('id');

		$property_list = \lib\app\product\property::get_pretty(\dash\request::get('id'), true);
		\dash\data::propertyList($property_list);

		$group = \dash\request::get('group');

		if(!$group && $group !== '0')
		{
			\dash\redirect::to($back);
		}

		if(!($group = \dash\validate::string_50($group)))
		{
			\dash\redirect::to($back);
		}

		if(!isset($property_list[$group]))
		{
			\dash\redirect::to($back);
		}

		\dash\data::groupTitle($group);

	}
}
?>