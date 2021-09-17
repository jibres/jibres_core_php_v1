<?php
namespace content_a\discount\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Add new discount code"));


		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
		

		\dash\data::include_adminPanelBuilder(true);
	}
}
?>
