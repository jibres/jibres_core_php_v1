<?php
namespace lib\app\quickaccess;


class forms
{
	/**
	 * Load all setting links
	 */
	public static function list($_query_string)
	{
		$search = \lib\app\form\form\search::list($_query_string, []);

		if(!$search || !is_array($search))
		{
			return [];
		}


		$new_list = [];

		$edit_url = \dash\url::kingdom(). '/a/form/edit?id=%s';

		foreach ($search as $key => $value)
		{
			$new_list[] =
			[
				'icon'  => 'edit',
				'title' => a($value, 'title'),
				'addr'  => [T_("CRM"), T_("Form builder"), '#'. \dash\fit::text(a($value, 'id'))],
				'url'   => sprintf($edit_url, a($value, 'id')),
			];
		}

		return $new_list;
	}
}
?>