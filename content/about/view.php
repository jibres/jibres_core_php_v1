<?php
namespace content\about;


class view
{
	public static function config()
	{
		\dash\face::title(T_('About Jibres'));
		\dash\face::desc(T_("Advancement of technology and development of Web-based business Cause Need new tools to resolve the daily needs and that’s the goal of making Jibres."));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-about-en-1.jpg');

	}
}
?>