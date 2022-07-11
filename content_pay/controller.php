<?php
namespace content_pay;


class controller
{
	public static function routing()
	{
		if(\dash\engine\store::inStore())
		{
			// nothing
		}
		else
		{
			if(\dash\engine\store::admin_subdomain())
			{
				\dash\redirect::admin_subdomain();
			}
			else
			{
				\dash\redirect::remove_subdomain();
			}
		}

		\dash\utility\pay\get::config();

	}
}
?>