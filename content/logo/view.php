<?php
namespace content\logo;


class view
{
	public static function config()
	{
		\lib\data::page(T_('Jibres Logo'), 'title');
		\lib\data::page(T_('Need know more about Jibres Logo? We are not choose our final logo yet!'), 'desc');
	}
}
?>