<?php
namespace content_r10\domain\lists;


class view
{
	public static function config()
	{

		$args =
		[
			'order' => \dash\request::get('order'),
			'sort'  => \dash\request::get('sort'),
		];

		$search_string = \dash\validate::search_string();

		$list = \lib\app\nic_domain\search::list($search_string, $args);

		$isFiltered    = \lib\app\nic_domain\search::is_filtered();

		$meta =
		[
			'is_filtered'    => $isFiltered,
		];

		\dash\notif::meta($meta);

		\content_r10\tools::say($list);
	}
}
?>