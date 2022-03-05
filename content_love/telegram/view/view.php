<?php
namespace content_love\telegram\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Show telegram log detail"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
