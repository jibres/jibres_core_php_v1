<?php
namespace content_b1\category\child;


class view
{

	public static function config()
	{
		$id = \dash\request::get('id');
		$list = \lib\app\category\search::list_child($id, \dash\request::get('q'));

		if(!is_array($list))
		{
			$list = [];
		}


		$list = array_map(['\\content_b1\\category\\fetch\\view', 'ready'], $list);

		\content_b1\tools::say($list);

	}

}
?>