<?php
namespace content_business\cart;


class view
{
	public static function config()
	{
		// load cart detail once
		\lib\app\cart\checkout::cart_detail();

		$title = T_("Shopping Cart"). ' ('. \dash\fit::number(\dash\data::myCart_count()). ')';

		\dash\face::titlePWA($title);
		\dash\face::title($title);


		if(\dash\user::login())
		{
			\dash\data::back_link(\dash\url::kingdom(). '/profile');
		}
		else
		{
			\dash\data::back_link(\dash\url::kingdom());
		}


	}
}
?>
