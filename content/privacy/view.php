<?php
namespace content\privacy;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Privacy Policy'). ' | '. T_("Jibres"));
		\dash\face::desc(T_('We wish to assure you that our main concern is to secure your privacy and protect your information against impermissible access.'));

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-privacy-1.jpg');

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>