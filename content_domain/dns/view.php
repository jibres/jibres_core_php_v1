<?php
namespace content_domain\dns;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("DNS list"));

		\dash\data::page_special(true);


		// btn
		\dash\data::page_btnText(T_('Add dns'));
		\dash\data::page_btnLink(\dash\url::this(). '/add');

		// btn
		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::here());

		// $list = \lib\app\nic_dns\search::my_list();
		// \dash\data::dataTable($list);
	}
}
?>