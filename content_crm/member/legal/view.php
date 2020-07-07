<?php
namespace content_crm\member\legal;


class view
{
	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		\dash\face::title(T_('Edit user legal detail'));

		\content_crm\member\main\view::static_var();

		\dash\data::dataRowLegal(\dash\app\user\legal::get(\dash\request::get('id')));
	}
}
?>