<?php
namespace content\about;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('About Jibres'));
		\dash\data::page_desc(\dash\data::site_desc());
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

	}
}
?>