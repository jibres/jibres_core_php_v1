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

		if(\dash\request::get('all'))
		{
			$list = \lib\app\nic_contact\search::my_list();
		}
		else
		{
			$list = \lib\app\nic_contact\search::list(null, $args);


			$filterBox     = \lib\app\nic_contact\search::filter_message();
			$isFiltered    = \lib\app\nic_contact\search::is_filtered();

			$meta =
			[
				'filter_message' => $filterBox,
				'is_filtered'    => $isFiltered,
			];

			\dash\notif::meta($meta);
		}

		\content_r10\tools::say($list);
	}
}
?>