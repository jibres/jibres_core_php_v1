<?php
namespace content_b1\user\fetch;


class view
{
	public static function config()
	{

		$args =
		[
			'order'      => \dash\request::get('order'),
			'sort'       => \dash\request::get('sort'),
			'status'     => \dash\request::get('status'),
			'permission' => \dash\request::get('permission'),
			'hm'         => \dash\request::get('hm'),
			'ho'         => \dash\request::get('ho'),
			'hc'         => \dash\request::get('hc'),
			'hp'         => \dash\request::get('hp'),
			'show_type'  => 'all',
		];

		$search_string   = \dash\validate::search(\dash\request::get('q'));

		$userList = \dash\app\user\search::list($search_string, $args);

		if(!is_array($userList))
		{
			$userList = [];
		}

		$userList = array_map(['\\dash\\app\\user', 'ready_api'], $userList);

		$isFiltered = \dash\app\user\search::is_filtered();
		\dash\notif::meta(['is_filtered' => $isFiltered]);

		\content_b1\tools::say($userList);

	}


}
?>