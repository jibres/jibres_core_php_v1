<?php
namespace content_love\gift\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Gift card Management"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		if(\dash\request::get('id'))
		{
			$load = \lib\app\gift\get::by_id(\dash\request::get('id'));
			\dash\data::dataRow($load);
		}
	}
}
?>