<?php
namespace content_a\form\item\duplicatelist;


class controller
{
	public static function routing()
	{
		\dash\allow::file();

		\content_a\form\tag\controller::loadForm();

		$item = \dash\request::get('item');

		$load_item = \lib\app\form\item\get::get($item);
		if(!$load_item)
		{
			\dash\header::status(404);
		}

		if(!in_array(a($load_item, 'type'), ['nationalcode', 'email', 'mobile']))
		{
			\dash\header::status(404, T_("This item have not duplicate list"));
		}

		\dash\data::itemDetail($load_item);

	}
}
?>
