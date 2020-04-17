<?php
namespace content_love\gift\create\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Choose type of gift card"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\content_love\gift\create\stepGuide::set();


	}
}
?>