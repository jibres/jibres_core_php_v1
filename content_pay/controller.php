<?php
namespace content_pay;


class controller
{
	public static function routing()
	{
		if(is_callable(['\\lib\\payment', 'config']))
		{
			\lib\payment::config();
		}

	}
}
?>