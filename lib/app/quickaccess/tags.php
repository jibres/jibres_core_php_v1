<?php
namespace lib\app\quickaccess;


class tags
{
	/**
	 * Load all setting links
	 */
	public static function list($_query_string)
	{
		$search = \lib\app\tag\search::list($_query_string, []);

		if(!$search || !is_array($search))
		{
			return [];
		}


		$new_list = [];

		$edit_url = \dash\url::kingdom(). '/a/tag/edit?id=%s';

		foreach ($search as $key => $value)
		{
			$new_list[] =
			[
				'icon'  => 'tag',
				'title' => a($value, 'title'),
				'addr'  => [T_("Setting"), T_("Products"), T_("Tags"), '#'. \dash\fit::text(a($value, 'id'))],
				'url'   => sprintf($edit_url, a($value, 'id')),
			];
		}

		return $new_list;
	}
}
?>