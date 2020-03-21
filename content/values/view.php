<?php
namespace content\values;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Jibres Values'));
		\dash\data::page_desc(T_("Jibres is a values driven organization. Here is what we believe in."). ' '. T_("Simplicity"). ' - '. T_("Transparency"). ' - '. T_("Responsibility"). ' - '. T_("Love"));
		// btn
		\dash\data::back_text(T_('About Jibres'));
		\dash\data::back_link(\dash\url::kingdom(). '/about');
	}
}
?>