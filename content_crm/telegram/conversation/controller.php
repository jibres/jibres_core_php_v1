<?php
namespace content_crm\telegram\conversation;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmTelegram');
	}
}
?>
