<?php
namespace lib\app\quickaccess;


class customers
{
	/**
	 * Load all setting links
	 */
	public static function list($_query_string)
	{
		$search = \dash\app\user\search::list($_query_string, []);

		if(!$search || !is_array($search))
		{
			return [];
		}

		$new_list = [];

		$edit_url = \dash\url::kingdom(). '/crm/member/general?id=%s';

		foreach ($search as $key => $value)
		{
			$new_list[] =
			[
				'img'   => a($value, 'avatar'),
				// 'icon'  => 'tag',
				'title' => a($value, 'displayname'),
				'addr'  => [T_("Customers"), \dash\fit::text(a($value, 'mobile'))],
				'url'   => sprintf($edit_url, a($value, 'id')),
			];
		}

		return $new_list;
	}
}
?>