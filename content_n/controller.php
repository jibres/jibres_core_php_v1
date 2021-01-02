<?php
namespace content_n;

class controller
{
	public static function routing()
	{
		if(\dash\engine\store::inStore())
		{
			\lib\store::check_master_business_config();
		}
	}
}
?>