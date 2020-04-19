<?php
namespace content_love\gift\edit;


class controller
{
	public static function routing()
	{
		$id = \dash\validate::code(\dash\request::get('id'));
		if(!$id)
		{
			if($_redirect)
			{
				\dash\redirect::to(\dash\url::this());
			}
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