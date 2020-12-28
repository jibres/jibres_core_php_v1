<?php
namespace dash\app\posts;

class add
{

	public static function add($_args)
	{
		// check args
		$args = \dash\app\posts\check::variable($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		unset($args['tag']);

		$args['user_id'] = \dash\user::id();

		$return         = [];

		$post_id = \dash\db\posts::insert($args);

		if(!$post_id)
		{
			\dash\log::oops('dbErrorInsertPost', T_("No way to insert post"));
			return false;
		}


		$return['post_id'] = \dash\coding::encode($post_id);

		\dash\log::set('addNewPost', ['code' => $post_id, 'datalink' => $return['post_id']]);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Post successfuly added"));
		}

		return $return;
	}
}
?>