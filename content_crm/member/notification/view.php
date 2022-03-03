<?php
namespace content_crm\member\notification;


class view
{
	public static function config()
	{

		\content_crm\member\master::view();

		\dash\face::title(T_('Notification setting'));



	}
}
?>