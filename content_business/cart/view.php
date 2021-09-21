<?php
namespace content_business\cart;


class view
{
	public static function config()
	{
		\content_business\view::load_cart_detail();

		$title = T_("Shopping Cart"). ' ('. \dash\fit::number(\dash\data::myCart_count()). ')';

		\dash\face::titlePWA($title);
		\dash\face::title($title);


		// btn
		\dash\data::back_link(\dash\url::kingdom());

	}
}
?>
