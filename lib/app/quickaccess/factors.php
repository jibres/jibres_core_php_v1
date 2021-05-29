<?php
namespace lib\app\quickaccess;


class factors
{
	/**
	 * Load all setting links
	 */
	public static function list($_query_string)
	{
		$search = \lib\app\factor\search::list($_query_string, []);

		if(!$search || !is_array($search))
		{
			return [];
		}


		$new_list = [];

		$edit_url = \dash\url::kingdom(). '/a/order/detail?id=%s';

		foreach ($search as $key => $value)
		{
			$new_list[] =
			[
				'icon'  => 'cart-arrow-down',
				'title' => '#'. a($value, 'id'),
				'addr'  => [T_("Orders"),],
				'url'   => sprintf($edit_url, a($value, 'id')),
			];
		}

		return $new_list;
	}
}
?>