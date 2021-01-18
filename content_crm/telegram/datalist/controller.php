<?php
namespace content_crm\telegram\datalist;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmTelegram');
	}
}
?>
