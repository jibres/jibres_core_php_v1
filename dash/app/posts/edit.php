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

		if(isset($_args['status']))
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

			if(isset($load_posts['subtype']) && isset($args['subtype']) && $load_posts['subtype'] !== $args['subtype'])
			{
				if(!self::check_change_subtype($load_posts, $load_posts['subtype'], $args['subtype']))
				{
					// return false;
				}

			}

			if(isset($args['status']) && $args['status'] === 'publish')
			{
				if(!self::check_publishable($load_posts))
				{
					// return false;
				}
			}

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


	private static function check_publishable($_data)
	{
		$result = \dash\app\posts\ready::row($_data);

		if(a($result, 'subtype') === 'video')
		{
			if(a($result, 'gallery_array', 0, 'type') === 'video' && is_array(a($result, 'gallery_array')) && count(a($result, 'gallery_array')) === 1)
			{
				// can change to video
				return true;
			}
			else
			{
				\dash\notif::warn(T_("When post set on type video you must be have fill the video file to publish"));
				return false;
			}

		}

		if(a($result, 'subtype') === 'audio')
		{
			if(a($result, 'gallery_array', 0, 'type') === 'audio' && is_array(a($result, 'gallery_array')) && count(a($result, 'gallery_array')) === 1)
			{
				// can change to audio
				return true;
			}
			else
			{
				\dash\notif::warn(T_("When post set on type audio you must be have fill the audio file to publish"));
				return false;
			}

		}

		return true;

	}


	private static function check_change_subtype($_data, $_old_subtype, $_new_subtype)
	{
		if($_old_subtype === $_new_subtype)
		{
			// no change in subtype
			return true;
		}

		if($_new_subtype === 'gallery')
		{
			// every type can change to gallery
			return true;
		}

		if($_new_subtype === 'standard')
		{
			// every type can change to standard
			return true;
		}

		// if(isset($_data['status']) && $_data['status'] === 'publish')
		// {
		// 	\dash\notif::error(T_("Can not convert post type to video or podcast when post published"));
		// 	return false;
		// }

		$result = \dash\app\posts\ready::row($_data);

		if($_new_subtype === 'video')
		{
			if(a($result, 'gallery_array', 0, 'type') === 'video' && is_array(a($result, 'gallery_array')) && count(a($result, 'gallery_array')) === 1)
			{
				// can change to video
				return true;
			}
			elseif(!a($result, 'gallery_array'))
			{
				// nothing
				return true;
			}
			else
			{
				\dash\notif::warn(T_("To convert to video you must have only one gallery items and that must be a video"));
				return false;
			}

		}

		if($_new_subtype === 'audio')
		{
			if(a($result, 'gallery_array', 0, 'type') === 'audio' && is_array(a($result, 'gallery_array')) && count(a($result, 'gallery_array')) === 1)
			{
				// can change to audio
				return true;
			}
			elseif(!a($result, 'gallery_array'))
			{
				// nothing
				return true;
			}
			else
			{
				\dash\notif::warn(T_("To convert to audio you must have only one gallery items and that must be a audio"));
				return false;
			}

		}

		return true;

	}
}
?>