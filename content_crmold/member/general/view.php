<?php
namespace content_crm\member\general;


class view
{
	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		\dash\face::title(T_('Edit user general detail'));

		\content_crm\member\main\view::static_var();
	}
}
?>