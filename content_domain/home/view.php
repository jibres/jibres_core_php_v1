<?php
namespace content_domain\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Jibres Domain"));

		\dash\data::page_special(true);


		$list = \lib\app\nic_domain\search::my_list();
		\dash\data::dataTable($list);
	}
}
?>
