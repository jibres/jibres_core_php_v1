<?php
namespace content_my\domain\option;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain setting"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$my_setting = \lib\app\nic_usersetting\get::get();
		\dash\data::dataRow($my_setting);

	}
}
?>