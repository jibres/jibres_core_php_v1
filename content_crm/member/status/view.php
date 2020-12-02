<?php
namespace content_crm\member\status;


class view
{
	public static function config()
	{

		\content_crm\member\master::view();

		\dash\face::title(T_('Change user status'));
	}
}
?>