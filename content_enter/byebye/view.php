<?php
namespace content_enter\byebye;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Delete Account'));
		\dash\face::desc(\dash\face::title());
		//put logout
		\dash\log::set('userByeBye');
		\dash\utility\enter::set_logout(\dash\user::id(), false);
	}
}
?>