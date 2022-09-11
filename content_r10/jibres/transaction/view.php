<?php
namespace content_r10\jibres\transaction;


class view
{

	public static function config()
	{

		$args =
			[
				'order'       => \dash\request::get('order'),
				'sort'        => \dash\request::get('sort'),
				'status'      => \dash\request::get('status'),
				'verify'      => \dash\request::get('verify'),
				'user_code'   => \dash\request::get('user'),
				'charge_type' => \dash\request::get('charge_type'),
				'start_date'  => \dash\request::get('std'),
				'end_date'    => \dash\request::get('end'),
				'caller'      => \dash\request::get('caller'),
				'store_id'    => \dash\request::get('store_id'),

			];


		$search_string   = \dash\validate::search_string();
		$transactionList = \dash\app\transaction\search::list($search_string, $args);

		$meta =
			[
				'is_filtered' => \dash\app\transaction\search::is_filtered(),
			];


		\dash\notif::meta($meta);

		\content_r10\tools::say($transactionList);

	}

}

?>