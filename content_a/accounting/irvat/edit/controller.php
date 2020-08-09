<?php
namespace content_a\accounting\irvat\edit;


class controller
{
	public static function routing()
	{
		$id = \dash\validate::id(\dash\request::get('id'));
		if(!$id)
		{
			\dash\redirect::to(\dash\url::this());
			return;
		}

		$load = \lib\app\irvat\get::get($id);

		if(!$load)
		{
			\dash\header::status(404, T_("ID not found"));
		}

		\dash\data::dataRow($load);

	}
}
?>