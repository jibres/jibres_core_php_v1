<?php
namespace content\changelog;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Change log of Jibres'));
		\dash\data::page_desc(T_('We were born to do Best!'). ' ' . T_("We are Developers, please wait!"));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>