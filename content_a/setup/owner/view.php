<?php
namespace content_a\setup\owner;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Complete your profile'));
		\dash\data::dataRow(\dash\user::detail());
	}
}
?>
