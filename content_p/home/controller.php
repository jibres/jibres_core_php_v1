<?php
namespace content_p\home;

class controller
{
	public static function routing()
	{
		$module = \dash\url::module();

		$load_product = \lib\app\product\load::site($module);
		if(!$load_product)
		{
			return false;
		}

		\dash\data::dataRow($load_product);

		\dash\open::get();
	}
}
?>