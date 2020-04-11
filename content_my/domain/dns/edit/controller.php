<?php
namespace content_my\domain\dns\edit;


class controller
{
	public static function routing()
	{
		\content_my\domain\controller::check_login();

		if(\lib\nic\mode::api())
		{
			$get_api    = new \lib\nic\api();
			$detail     = $get_api->dns_load(\dash\request::get('id'));

		}
		else
		{
			$detail = \lib\app\nic_contact\get::load();
		}

		if(!$detail)
		{
			\dash\header::status(403, T_("Invalid id"));
		}

		\dash\data::dataRow($detail);
	}
}
?>