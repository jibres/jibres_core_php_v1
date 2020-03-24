<?php
namespace content\privacy;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Privacy Policy'). ' | '. T_("Jibres"));
		\dash\data::page_desc(T_('We wish to assure you that our main concern is to secure your privacy and protect your information against impermissible access.'));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>