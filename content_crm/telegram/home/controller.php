<?php
namespace content_crm\telegram\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmTelegram');
		\dash\redirect::to(\dash\url::this(). '/datalist');
	}
}
?>
