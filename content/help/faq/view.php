<?php
namespace content\help\faq;


class view
{
	public static function config()
	{
		\dash\data::page(T_('Frequently Asked Questions'), 'title');
		\dash\data::page(T_('This FAQ provides answers to basic questions about Jibres.'), 'desc');
	}
}
?>