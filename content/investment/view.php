<?php
namespace content\investment;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Business Plan'));
		\dash\face::desc(T_('If you are interested in investing in Jibres, we have created this page for you to answer your questions'));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-investment-cover-1.jpg');

	}
}
?>