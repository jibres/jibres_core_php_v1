<?php
namespace content_my\bill;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Pay bill'));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());
	}
}
?>