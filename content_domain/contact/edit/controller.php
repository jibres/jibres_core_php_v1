<?php
namespace content_domain\contact\edit;


class controller
{
	public static function routing()
	{
		\content_domain\controller::check_login();
		$detail = \lib\app\nic_contact\get::load();
		if(!$detail)
		{
			\dash\header::status(403, T_("Invalid id"));
		}

		\dash\data::dataRow($detail);
	}
}
?>