<?php
namespace lib\app\quickaccess;


class products
{
	/**
	 * Load all setting links
	 */
	public static function list($_query_string)
	{
		$search = \lib\app\product\search::variant_list($_query_string, []);
		if(!$search || !is_array($search))
		{
			return [];
		}

		$new_list = [];

		foreach ($search as $key => $value)
		{
			$new_list[] =
			[
				'img'   => a($value, 'thumb'),
				// 'icon'  => 'tag',
				'title' => a($value, 'title'),
				'addr'  => [T_("Products"), '#'. \dash\fit::text(a($value, 'id'))],
				'url'   => a($value, 'edit_url'),
			];
		}

		return $new_list;
	}
}
?>