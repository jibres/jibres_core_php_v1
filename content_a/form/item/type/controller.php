<?php
namespace content_a\form\item\type;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');

		$load = \lib\app\form\form\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);

		$item = \dash\request::get('item');

		$load_item = \lib\app\form\item\get::get($item);
		if(!$load_item)
		{
			\dash\header::status(404);
		}

		\dash\data::itemDetail($load_item);

		// var_dump($load_item);exit();



	}
}
?>
