<?php
namespace content\certificates;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Certificates'). ' | '. T_("Jibres"));
		\dash\face::desc(T_('We are get all of certificates!'));


		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-certificates-1.jpg');
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

	}
}
?>