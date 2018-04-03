<?php
namespace content\enterprise;


class view
{
	public static function config()
	{
		\lib\data::page(T_('Enterprise'), 'title');
		\lib\data::page(T_('Have a headaches? We have soulutions. Be patient...'), 'desc');
	}
}
?>