<?php
namespace content_subdomain\p\home;

class controller
{
	public static function routing()
	{
		$child = \dash\url::child();

		$load_product = \lib\app\product\load::site($child);

		if(!$load_product)
		{
			return false;
		}

		\dash\data::dataRow($load_product);

		\dash\open::get();
		\dash\open::post();
	}
}
?>