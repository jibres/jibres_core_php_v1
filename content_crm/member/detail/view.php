<?php
namespace content_crm\member\detail;


class view
{
	public static function config()
	{
		\content_crm\member\master::view();

		\dash\face::title(T_('Update customer name and avatar'));
	}
}
?>