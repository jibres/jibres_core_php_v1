<?php
namespace content\help;


class view
{
	public static function config()
	{
		\lib\data::page(T_('Help Center'), 'title');
		\lib\data::page(T_('Need HELP? Be patient...'), 'desc');
	}
}
?>