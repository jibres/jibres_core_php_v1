<?php
namespace content\enterprise;


class view
{
	public static function config()
	{
		\dash\data::page(T_('Enterprise'), 'title');
		\dash\data::page(T_('Have a headaches? We have soulutions. Be patient...'), 'desc');
	}
}
?>