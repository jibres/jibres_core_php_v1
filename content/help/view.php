<?php
namespace content\help;


class view
{
	public static function config()
	{
		\dash\data::page(T_('Help Center'), 'title');
		\dash\data::page(T_('Need HELP? Be patient...'), 'desc');
	}
}
?>