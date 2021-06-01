<?php
namespace content_pay\home;


class controller
{
	public static function routing()
	{
		\dash\csrf::set();

		$token = \dash\url::module();
		if($token && mb_strlen($token) === 32)
		{
			$load = \dash\utility\pay\setting::load_token($token);

			if($load)
			{
				\dash\data::dataRow($load);
				\dash\open::get();
				\dash\open::post();
			}
			else
			{
				\dash\header::status(T_("Invalid payment token!"));
			}

			\dash\data::transactionMode(true);
		}


	}
}
?>