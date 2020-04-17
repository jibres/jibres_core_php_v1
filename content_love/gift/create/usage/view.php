<?php
namespace content_love\gift\create\usage;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Set usage of gift card"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\content_love\gift\create\stepGuide::set();

	}
}
?>