<?php
namespace content_crm\member\identification;


class view
{
	public static function config()
	{
		\content_crm\member\master::view();
		\content_crm\member\master::static_var();

		\dash\face::title(T_('Member identification detail'));
	}
}
?>