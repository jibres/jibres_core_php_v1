<?php
namespace content_enter\delete;


class view
{
	public static function config()
	{
		if(\dash\utility\enter::get_session('request_delete_msg'))
		{
			\dash\data::getWhy(\dash\utility\enter::get_session('request_delete_msg'));
		}

		\dash\face::title(T_('Delete account'));
		\dash\face::desc(\dash\face::title());
	}
}
?>