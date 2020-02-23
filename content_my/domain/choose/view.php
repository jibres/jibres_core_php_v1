<?php
namespace content_my\domain\choose;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Buy domain"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::page_special(true);

		$q = \dash\request::get('q');
		\dash\data::myDomain($q);
		$info = \lib\app\nic_domain\check::multi_check($q);

		\dash\data::infoResult($info);
	}
}
?>