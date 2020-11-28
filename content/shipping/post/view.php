<?php
namespace content\shipping\post;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Postal Service Shipping Calculator'));
		\dash\face::desc(T_("Determining the cost of shipping domestically is now made easy. Simply fill in the blanks, and let our online calculator figure out your postage."));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-shipping-1.jpg');

	}
}
?>