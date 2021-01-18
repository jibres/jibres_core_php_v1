<?php
namespace content_crm\telegram\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Show telegram chat detail"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
