<?php
namespace content_crm\ticket\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Add new ticket"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}

}
?>
