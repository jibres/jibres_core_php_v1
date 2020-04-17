<?php
namespace content_love\gift\create;


class controller
{
	public static function routing()
	{
		\dash\redirect::to(\dash\url::that(). '/add');
	}


	public static function load()
	{
		$id = \dash\validate::code(\dash\request::get('id'));
		if(!$id)
		{
			\dash\redirect::to(\dash\url::that());
			return;
		}

		$load = \lib\app\gift\get::by_id($id);

		if(!$load)
		{
			\dash\header::status(404, T_("ID not found"));
		}

		\dash\data::dataRow($load);
	}
}
?>