<?php
namespace content\help\faq;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Frequently Asked Questions'));
		\dash\data::page_desc(T_('This FAQ provides answers to basic questions about Jibres.'));

		// btn
		\dash\data::back_text(T_('Help Center'));
		\dash\data::back_link(\dash\url::kingdom(). '/help');
	}
}
?>