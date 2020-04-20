<?php
namespace content_my\domain\renew;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Renew domain"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$list = \lib\app\nic_contact\search::my_list();
		\dash\data::myContactList($list);

	}
}
?>