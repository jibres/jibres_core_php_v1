<?php
namespace content_v2\business\posts\fetch;


class view
{

	public static function config()
	{
		$args = [];

		$limit = \dash\request::get('limit');

		if($limit && is_numeric($limit) && intval($limit) > 1 && intval($limit) < 100)
		{
			$args['limit'] = intval($limit);
		}

		$posts  = \dash\app\posts::get_post_list($args);

		if(!$posts)
		{
			\dash\notif::info(T_("No posts was found"));
		}

		\content_v2\tools::say($posts);
	}

}
?>