<?php
namespace lib\app\quickaccess;


class hashtags
{
	/**
	 * Load all setting links
	 */
	public static function list($_query_string)
	{
		$search = \dash\app\terms\search::list($_query_string, []);

		if(!$search || !is_array($search))
		{
			return [];
		}

		$new_list = [];

		$edit_url = \dash\url::kingdom(). '/cms/hashtag/edit?id=%s';

		foreach ($search as $key => $value)
		{
			$new_list[] =
			[
				'icon'  => 'pound',
				'title' => a($value, 'title'),
				'addr'  => [T_("CMS"), T_("Hashtags"),],
				'url'   => sprintf($edit_url, a($value, 'id')),
			];
		}

		return $new_list;
	}
}
?>