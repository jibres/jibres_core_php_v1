<?php
namespace content_b1\user\notifications\fetch;


class view
{
	public static function config()
	{
		$id = \dash\request::get('userid');



		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'notif'  => 1,
			'touser' => \dash\request::get('userid'),

		];

		$search_string = \dash\validate::search_string();

		$list = \dash\app\log\search::list($search_string, $args);

		if(!is_array($list))
		{
			$list = [];
		}

		$new_list = [];
		foreach ($list as $key => $value)
		{
			$new_list[] =
			[
				'txt'         => a($value, 'txt'),
				'displayname' => a($value, 'displayname'),
				'mobile'      => a($value, 'mobile'),
				'datecreated' => a($value, 'datecreated'),
			];
		}


		$isFiltered = \dash\app\log\search::is_filtered();
		\dash\notif::meta(['is_filtered' => $isFiltered]);


		\content_b1\tools::say($new_list);
	}
}
?>