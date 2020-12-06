<?php
namespace dash\app;


class smile
{

	public static function get()
	{
		\dash\temp::set('force_stop_visitor', true);
		\dash\temp::set('force_stop_query_log', true);

		$post               = [];
		$post['notifOn']    = \dash\request::post('notifOn'); // false
		$post['store_code'] = \dash\request::post('url-env'); // jb2jr
		$post['url-in']     = \dash\request::post('url-in'); // a
		$post['url-page']   = \dash\request::post('url-page'); // home


		$myResult = [];

		if(\dash\user::id())
		{
			$notifCount = \dash\app\log::my_notif_count();
			$orderCount = 0;

			if($post['store_code'])
			{
				$orderCount = self::detect_order($post['store_code']);
			}

			$myResult =
			[
				'notifNew'   => $notifCount ? true : false,
				'notifCount' => $notifCount,
				'orderCount' => $orderCount,
			];

		}
		else
		{
			// user not login
		}

		return $myResult;
	}


	private static function detect_order($_store_code)
	{
		$store_id = \dash\store_coding::decode($_store_code);
		if(!$store_id)
		{
			return false;
		}

		$store_detail = \lib\app\store\get::by_id($store_id);

		if(!$store_detail)
		{
			return false;
		}

		$db_name = \dash\engine\store::make_database_name($store_id);
		$fuel    = \dash\get::index($store_detail, 'fuel');

		if(!$db_name || !$fuel)
		{
			return false;
		}

		$count_order = \lib\db\factors\get::count_new_order_fuel($fuel, $db_name);

		if(!is_numeric($count_order))
		{
			$count_order = 0;
		}

		return floatval($count_order);

	}
}
?>