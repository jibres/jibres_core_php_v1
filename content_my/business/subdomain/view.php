<?php
namespace content_my\business\subdomain;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Business address"));

		\lib\app\store\timeline::set('subdomain');

		\dash\data::userToggleSidebar(false);

		// if(\dash\detect\device::detectPWA())
		{
			// back
			\dash\data::back_text(T_('Cancel'));
			\dash\data::back_link(\dash\url::this());
		}
	}
}
?>
