<?php
namespace content\portfolio;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Portfolio'));
		\dash\face::desc(T_("All websites are fully customizable with drag and drop. Personalize your website, pick a domain and get online today"));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-portfolio-1.jpg');

	}
}
?>