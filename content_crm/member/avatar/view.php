<?php
namespace content_crm\member\avatar;


class view
{
	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		\dash\data::page_title(T_('Member avatar'));
		\dash\data::page_desc(T_('Allow to set and change avatar of member'));

	}
}
?>