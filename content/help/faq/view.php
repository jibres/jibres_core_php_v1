<?php
namespace content\help\faq;


class view
{
	public static function config()
	{
		\lib\data::page(T_('Frequently Asked Questions'), 'title');
		\lib\data::page(T_('This FAQ provides answers to basic questions about Jibres.'), 'desc');
	}
}
?>