<?php
namespace content_crm\member\detail;


class controller
{
	public static function routing()
	{
		\content_crm\member\master::load();

		\dash\allow::file();
	}
}
?>