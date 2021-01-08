<?php
namespace dash\app\posts;

class add
{

	public static function add($_args)
	{
		\dash\permission::access('cmsManagePost');
		// check args
		$args = \dash\app\posts\check::variable($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!$args['title'])
		{
			\dash\notif::error(T_("Title is required"));
			return false;
		}

		$tags = [];
		if($args['tags'])
		{
			$tags = $args['tags'];
		}

		unset($args['tags']);

		$args['user_id'] = \dash\user::id();

		$return         = [];

		$post_id = \dash\db\posts::insert($args);

		if(!$post_id)
		{
			\dash\log::oops('dbErrorInsertPost', T_("No way to insert post"));
			return false;
		}

		if(array_key_exists('tags', $_args))
		{
			\dash\app\posts\terms::save_post_term($tags, $post_id, 'tag');
		}

		if(isset($args['status']) && $args['status'] === 'publish')
		{
			\dash\utility\sitemap::posts($post_id);
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