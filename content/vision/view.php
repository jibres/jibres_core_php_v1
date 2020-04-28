<?php
namespace content\vision;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Vision'));
		\dash\face::desc(T_("World #1 Financial Platform."));

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-vision-1.jpg');

		// btn
		\dash\data::back_text(T_('About Jibres'));
		\dash\data::back_link(\dash\url::kingdom(). '/about');
	}
}
?>