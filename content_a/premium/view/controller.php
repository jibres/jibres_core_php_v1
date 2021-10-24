<?php
namespace content_a\premium\view;


class controller
{

	public static function routing()
	{
		$premium_key = \dash\url::subchild();

		if(!$premium_key)
		{
			\dash\redirect::to(\dash\url::this());
		}


		$load_premium = \lib\app\premium\get::detail($premium_key);
		if(!$load_premium)
		{
			\dash\header::status(404, T_("Premium key is invalid"));
		}

		\dash\data::premiumDetail($load_premium);
		\dash\open::get();
	}
}
?>