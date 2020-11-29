<?php
namespace content\shipping;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Shipping'));
		\dash\face::desc(T_("Statistically, shipping cost is among the main reasons why shoppers abandon shopping carts."));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-shipping-1.jpg');

	}
}
?>