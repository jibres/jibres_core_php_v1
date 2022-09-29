<?php
namespace content_a\form\item;


class controller
{
	public static function routing()
	{
		\content_a\form\tag\controller::loadForm();


		$item = \dash\request::get('item');

		$load_item = \lib\app\form\item\get::get($item);
		if(!$load_item)
		{
			\dash\header::status(404);
		}

		\dash\data::itemDetail($load_item);

		\dash\allow::file();
	}
}
?>
