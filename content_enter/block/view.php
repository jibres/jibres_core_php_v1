<?php
namespace content_enter\block;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Hey! You are Blocked!!'));
		\dash\face::desc(\dash\face::title());
	}
}
?>