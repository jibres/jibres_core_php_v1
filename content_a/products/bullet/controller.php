<?php
namespace content_a\products\bullet;


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

		$index = \dash\validate::smallint(\dash\request::get('index'), false);
		if(is_numeric($index))
		{
			$bullet = \dash\data::productDataRow_bullet();
			if(isset($bullet[$index]))
			{
				\dash\data::bulletIndex($index);
				\dash\data::editMode(true);
				\dash\data::dataRow($bullet[$index]);
			}
		}

	}
}
?>
