<?php
namespace content_crm\member\email;


class view
{
	public static function config()
	{

		\content_crm\member\master::view();

		\dash\face::title(T_('Change customer email address'));


		// need load all user email in jibres
	}
}
?>