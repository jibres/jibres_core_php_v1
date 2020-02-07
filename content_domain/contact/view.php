<?php
namespace content_domain\contact;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Add contact"));

		\dash\data::page_special(true);


		// btn
		\dash\data::page_btnText(T_('Add contact'));
		\dash\data::page_btnLink(\dash\url::this(). '/add');

		$list = \lib\app\nic_contact\search::my_list();
		\dash\data::dataTable($list);
	}
}
?>