<?php
namespace content_r10\irnic\contact\fetch;


class view
{
	public static function config()
	{

		$args =
		[
			// 'order'  => \dash\request::get('order'),
			// 'sort'   => \dash\request::get('sort'),
			// 'admin'  => \dash\request::get('admin'),
			// 'holder' => \dash\request::get('holder'),
			// 'tech'   => \dash\request::get('tech'),
			// 'bill'   => \dash\request::get('bill'),
		];

		// $search_string = \dash\request::get('q');

		$list = \lib\app\nic_contact\search::list(null, $args);

		\content_r10\tools::say($list);


	}
}
?>