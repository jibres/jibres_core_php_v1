<?php
namespace content_crm\member\business;


class controller
{
	public static function routing()
	{
		if(\dash\engine\store::inStore())
		{
			\dash\header::status(404, ';)');
		}

		if(!\dash\permission::supervisor())
		{
			\dash\header::status(404, ';)');
		}

		\content_crm\member\master::load();
	}
}
?>