<?php
namespace dash\app\posts;

class add
{

	/**
	 * add new user
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args)
	{
		\dash\permission::access('cmsAddNewPost');

		// check args
		$args = \dash\app\posts::check($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['user_id'] = \dash\user::id();




		$return         = [];

		$post_id = \dash\db\posts::insert($args);

		if(!$post_id)
		{
			\dash\log::oops('dbErrorInsertPost', T_("No way to insert post"));
			return false;
		}

		$cat = [];
		if(isset($_args['cat']) && is_array($_args['cat']))
		{
			$cat = $_args['cat'];
		}

		$tag = [];
		if(isset($_args['tag']))
		{
			$tag = $_args['tag'];
		}


		if(in_array($args['type'], ['post', 'help', 'mag']))
		{

			if($args['type'] === 'help')
			{
				if(\dash\permission::check('cpTagHelpAdd'))
				{
					\dash\app\posts::set_post_term($post_id, 'help_tag', 'posts', $tag);
				}
			}
			else
			{
				if(\dash\permission::check('cpTagAdd'))
				{
					\dash\app\posts::set_post_term($post_id, 'tag', 'posts', $tag);
				}
			}


			if($args['type'] === 'mag')
			{
				$post_url = \dash\app\posts::set_post_term($post_id, 'mag', 'posts', $cat);
			}
			else
			{
				$post_url = \dash\app\posts::set_post_term($post_id, 'cat', 'posts', $cat);
			}


			if($post_url !== false)
			{

				if($post_url)
				{
					\dash\db\posts::update(['url' => ltrim($post_url. '/'. $args['slug'], '/')], $post_id);
				}
				else
				{
					\dash\db\posts::update(['url' => $args['slug']], $post_id);
				}
			}
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