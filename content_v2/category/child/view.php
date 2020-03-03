<?php
namespace content_v2\category\child;


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


		$list = array_map(['\\content_v2\\category\\fetch\\view', 'ready'], $list);

		\content_v2\tools::say($list);

	}

}
?>