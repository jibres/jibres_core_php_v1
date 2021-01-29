<?php
namespace content_crm\telegram\send;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmTelegram');
	}
}
?>
