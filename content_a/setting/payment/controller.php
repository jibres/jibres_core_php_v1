<?php
namespace content_a\setting\payment;

class controller
{
	public static function routing()
	{
		\dash\permission::access('storeSettingPayment');
	}
}
?>