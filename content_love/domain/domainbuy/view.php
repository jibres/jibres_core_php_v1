<?php
namespace content_love\domain\domainbuy;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain buy"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());


	}
}
?>
