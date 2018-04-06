<?php
namespace content\help\faq;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Frequently Asked Questions'));
		\dash\data::page_desc(T_('This FAQ provides answers to basic questions about Jibres.'));
	}
}
?>