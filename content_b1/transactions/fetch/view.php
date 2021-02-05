<?php
namespace content_b1\transactions\fetch;


class view
{
	public static function config()
	{

		$args =
		[
			'order'     => \dash\request::get('order'),
			'sort'      => \dash\request::get('sort'),
			'status'    => \dash\request::get('status'),
			'verify'    => \dash\request::get('verify'),
			'show_type' => 'all',
		];


		$search_string   = \dash\validate::search(\dash\request::get('q'));
		$transactionList = \dash\app\transaction\search::list($search_string, $args);

		$isFiltered = \dash\app\transaction\search::is_filtered();
		\dash\notif::meta(['is_filtered' => $isFiltered]);


		\content_b1\tools::say($transactionList);
	}
}
?>