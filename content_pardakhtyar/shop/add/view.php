<?php
namespace content_pardakhtyar\shop\add;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_("Add new shop"));
		\dash\data::page_desc(T_('Increase number of shops by add new shop.'));
		\dash\data::page_pictogram('plus-circle');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back to list of shops'));

	}
}
?>