<?php
namespace content_my\domain\irnic\edit;


class controller
{
	public static function routing()
	{


		$detail = \lib\app\nic_contact\get::load();

		if(!$detail)
		{
			\dash\header::status(403, T_("Invalid id"));
		}

		\dash\data::dataRow($detail);
	}
}
?>