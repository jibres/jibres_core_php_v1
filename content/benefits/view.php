<?php
namespace content\logo;


class view
{
	public static function config()
	{
		\dash\data::page(T_('Jibres benefits'), 'title');
		\dash\data::page(T_('What can you do with Jibres?'), 'desc');
	}
}
?>