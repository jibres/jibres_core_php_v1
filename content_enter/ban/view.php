<?php
namespace content_enter\ban;


class view
{
	public static function config()
	{
		\dash\face::title(T_('You are Banned!!'));

		\dash\face::desc(\dash\face::title());
	}
}
?>