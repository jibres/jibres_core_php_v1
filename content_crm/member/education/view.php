<?php
namespace content_crm\member\education;


class view
{
	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		\dash\face::title(T_('Member education detail'));
	}
}
?>