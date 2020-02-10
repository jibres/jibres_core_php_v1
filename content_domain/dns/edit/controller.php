<?php
namespace content_domain\dns\edit;


class controller
{
	public static function routing()
	{
		\content_domain\controller::check_login();
		$detail = \lib\app\nic_dns\get::load();
		if(!$detail)
		{
			\dash\header::status(403, T_("Invalid id"));
		}

		\dash\data::dataRow($detail);
	}
}
?>