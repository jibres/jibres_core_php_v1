<?php
namespace dash\app\posts;


trait edit
{

	public static function edit($_args, $_id)
	{
		$_option = [];

		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit posta"), 'posta');
			return false;
		}

		$load_posts = \dash\db\posts::get(['id' => $id, 'limit' => 1]);

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
		$args = self::check($_args, $id, $_option);

		if($args === false || !\dash\engine\process::status())
		{
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


		if(!$args['excerpt'])
		{
			$args['excerpt'] = \dash\utility\excerpt::extractRelevant($args['content']);
		}

		if(mb_strlen($args['excerpt']) >= 300)
		{
			$args['excerpt'] = substr($args['excerpt'], 0, 299);
		}

		if(in_array($args['type'], ['post', 'help', 'mag']))
		{
			if($args['type'] === 'help')
			{
				if(\dash\permission::check('cpTagHelpAdd'))
				{
					self::set_post_term($id, 'help_tag', 'posts', $tag);
				}
			}
			else
			{
				if(\dash\permission::check('cpTagAdd'))
				{
					self::set_post_term($id, 'tag', 'posts', $cat);
				}
			}

			$post_url = self::set_post_term($id, 'cat', 'posts', $tag);

			if($post_url !== false)
			{
				if($post_url)
				{
					$args['url'] = ltrim($post_url. '/'. $args['slug'], '/');
				}
				else
				{
					$args['url'] = $args['slug'];
				}
			}
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(!empty($args))
		{
			\dash\log::set('editPost', ['code' => $id, 'datalink' => \dash\coding::encode($id)]);

			\dash\db\posts::update($args, $id);

			if(\dash\engine\process::status())
			{
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