<?php
namespace content_love\gift\create\message;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Gift card message"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\content_love\gift\create\stepGuide::set();

	}
}
?>