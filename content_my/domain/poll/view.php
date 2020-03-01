<?php
namespace content_my\domain\poll;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("IRNIC Notification"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());

		\lib\app\nic_poll\get::list();

		$my_list = \lib\app\nic_poll\get::my_list();
		\dash\data::dataTable($my_list);

	}
}
?>