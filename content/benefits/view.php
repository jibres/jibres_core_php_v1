<?php
namespace content\logo;


class view
{
	public static function config()
	{
		\lib\data::page(T_('Jibres benefits'), 'title');
		\lib\data::page(T_('What can you do with Jibres?'), 'desc');
	}
}
?>