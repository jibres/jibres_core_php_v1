<?php
namespace dash\app\posts;


class edit
{

	public static function edit($_args, $_id)
	{
		$_option = [];

		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Post id not set"));
			return false;
		}

		$load_posts = \dash\db\posts\get::by_id($id);

		if(!isset($load_posts['id']))
		{
			\dash\notif::error(T_("Invalid posts id"));
			return false;
		}

		if(array_key_exists('meta', $load_posts))
		{
			if(is_string($load_posts['meta']) && substr($load_posts['meta'], 0, 1) === '{')
			{
				$load_posts['meta'] = json_decode($load_posts['meta'], true);
			}
			elseif(is_array($load_posts['meta']))
			{
				// nothing
			}
			else
			{
				$load_posts['meta'] = [];
			}

			$_option['meta'] = $load_posts['meta'];
		}

		$_option['raw_args'] = $_args;

		// check args
		$args = \dash\app\posts\check::variable($_args, $id, $_option);
		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(isset($_args['redirecturl']))
		{
			$_args['meta'] = 'need - meta :/ ';
		}

		if(isset($_args['creator']) && $_args['creator'])
		{
			$_args['user_id'] = 'need - user_id :/ ';
		}

		if(isset($_args['content']) && $_args['content'])
		{
			$_args['excerpt'] = 'need - excerpt :/ ';
		}

		if(isset($_args['slug']))
		{
			$_args['url'] = 'need - url :/ ';
		}

		if($args['status'])
		{
			$_args['publishdate'] = 'need - url :/ ';
		}


		$tag = [];
		if($args['tag'])
		{
			$tag = $args['tag'];
		}

		$cat = [];
		if($args['cat'])
		{
			$cat = $args['cat'];
		}

		unset($args['cat']);
		unset($args['tag']);


		$args = \dash\cleanse::patch_mode($_args, $args);

		if(!empty($args))
		{
			\dash\log::set('editPost', ['code' => $id]);

			\dash\db\posts::update($args, $id);

			if(\dash\engine\process::status())
			{

				if(in_array($load_posts['type'], ['post', 'help']))
				{
					if(array_key_exists('tag', $_args))
					{
						\dash\app\posts\terms::save_post_term($tag, $load_posts['id'], 'tag');
					}

					if(array_key_exists('cat', $_args))
					{
						$post_url = \dash\app\posts\terms::save_post_term($cat, $load_posts['id'], 'cat');

						if($post_url === false)
						{
							return false;
						}

						if($post_url)
						{
							\dash\db\posts::update(['url' => ltrim($post_url. '/'. $load_posts['slug'], '/')], $load_posts['id']);
						}
						else
						{
							\dash\db\posts::update(['url' => $load_posts['slug']], $load_posts['id']);
						}

					}
					elseif(isset($args['slug']))
					{
						$url = \dash\db\termusages\get::first_category_url($load_posts['id']);

						if($url && is_string($url))
						{
							\dash\db\posts::update(['url' => ltrim($url. '/'. $args['slug'], '/')], $load_posts['id']);
						}
						else
						{
							\dash\db\posts::update(['url' => $args['slug']], $load_posts['id']);
						}
					}
				}

				\dash\notif::ok(T_("Post successfully updated"));
			}
		}
		else
		{
			\dash\notif::info(T_("Post save without changes"));
		}

	}
}
?>