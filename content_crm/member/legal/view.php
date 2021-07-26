<?php
namespace content_crm\member\legal;


class view
{
	public static function config()
	{

		\content_crm\member\master::view();
		\content_crm\member\master::static_var();

		\dash\face::title(T_('Edit user legal detail'));

		$haveCoding = \lib\app\tax\coding\get::have_any_coding();

		\dash\data::haveCoding($haveCoding);

		if($haveCoding)
		{
			\dash\data::detailsList(\lib\app\tax\coding\get::current_list_of('details'));
		}
	}
}
?>