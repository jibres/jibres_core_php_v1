<?php
namespace content_a\products\share;


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

		self::createMessageData();
	}


	public static function createMessageData()
	{
		$id = \dash\request::get('id');

		$cat_list = \lib\app\category\get::product_cat($id);
		if(is_array($cat_list) && $cat_list)
		{
			$cat_list = array_column($cat_list, 'title');
		}
		else
		{
			$cat_list = [];
		}
		$catStr = '';
		foreach ($cat_list as $key => $value)
		{
			$tag = str_replace(' ', '_', $value);
			$catStr .= '#'. $tag. ' ';
		}
		$catStr = trim($catStr);
		\dash\data::catStr($catStr);
	}
}
?>
