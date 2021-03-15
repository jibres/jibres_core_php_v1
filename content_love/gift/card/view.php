<?php
namespace content_love\gift\card;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Gift card preview"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/all');

		if(\dash\request::get('id'))
		{
			$load = \lib\app\gift\get::by_id(\dash\request::get('id'));
			\dash\data::dataRow($load);
		}
		else
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>