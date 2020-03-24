<?php
namespace content_crm\member\identification;


class view
{
	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		\content_crm\member\main\view::static_var();

		\dash\data::page_title(T_('Member identification detail'));
	}
}
?>