<?php
namespace dash\app\posts;


class edit
{

	public static function edit($_args, $_id, $_force = false)
	{
		if($_force)
		{
			// force add new post. pagebuilder mode
		}
		else
		{
			\dash\permission::access('cmsManagePost');
		}

		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Post id not set"));
			return false;
		}

		$load_posts = \dash\app\posts\get::load_post($_id, $_force);

		if(!isset($load_posts['id']))
		{
			\dash\notif::error(T_("Invalid posts id"));
			return false;
		}

		// check args
		$args = \dash\app\posts\check::variable($_args, $id, $_force);


		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$exception = [];


		if(isset($_args['creator']) && $_args['creator'])
		{
			$exception[] = 'user_id';
		}


		if(isset($_args['tagurl']) || (isset($load_posts['type']) && in_array($load_posts['type'], ['pagebuilder', 'page']) && isset($_args['slug'])))
		{
			$exception[] = 'url';
		}

		if(isset($_args['status']))
		{
			$exception[] = 'publishdate';
		}

		if(\dash\temp::get('exception_post_meta'))
		{
			$exception[] = 'meta';
		}


		$tags = [];
		if($args['tags'])
		{
			$tags = $args['tags'];
		}

		unset($args['tags']);


		$args = \dash\cleanse::patch_mode($_args, $args, $exception);

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

			if(isset($load_posts['status']) && $load_posts['status'] === 'publish')
			{
				if(array_key_exists('publishdate', $_args) && !a($args, 'publishdate'))
				{
					\dash\notif::error(T_("Publish date is required when post is published"), ['element' => ['publishdate', 'publishtime']]);
					return false;
				}
			}

			$content = false;
			if(array_key_exists('content', $args))
			{
				$content = $args['content'];
				unset($args['content']);
			}

			if(\dash\temp::get('analyzeCotent') && is_array(\dash\temp::get('analyzeCotent')))
			{
				$args['analyzecontent'] = json_encode(\dash\temp::get('analyzeCotent'));
			}

			if(!empty($args))
			{
				if(!a($args, 'datemodified'))
				{
					$args['datemodified'] = date("Y-m-d H:i:s");
				}

				\dash\db\posts\update::record($args, $id);
			}

			if($content !== false)
			{
				\dash\db\posts\update::update_content($content, $id);
			}

			self::check_update_sitemap($load_posts, $args);

			if(array_key_exists('url', $args))
			{
				if(a($load_posts, 'type') === 'pagebuilder')
				{
					\lib\app\menu\update::page($id, true);
				}
				else
				{
					\lib\app\menu\update::post($id, true);
				}
			}

			if(\dash\engine\process::status())
			{

				if(array_key_exists('tags', $_args))
				{
					if($content)
					{
						$tags = \dash\app\terms\find::tag($content, $tags);
					}

					\dash\app\posts\terms::save_post_term($tags, $id, 'tag');
				}

				// calculate seo rank after save post
				$load_posts = \dash\app\posts\get::load_post($_id, $_force);

				$seo_detail            = [];
				$seo_detail['type']    = 'post';
				$seo_detail['id']      = a($load_posts, 'id');
				$seo_detail['title']   = a($load_posts, 'post_title');
				$seo_detail['seodesc'] = a($load_posts, 'excerpt');
				$seo_detail['content'] = a($load_posts, 'content');
				$seo_detail['tags']    = a($load_posts, 'tags');

				$seoAnalyze    = \dash\seo::analyze($seo_detail);

				if(isset($seoAnalyze['rank']))
				{
					\dash\db\posts\update::record(['seorank' => $seoAnalyze['rank']], $id);
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
		$result = $_data;

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


	private static function check_update_sitemap($_data, $_args)
	{
		$post_id = a($_data, 'id');
		$post_id = \dash\coding::decode($post_id);

		$need_update = false;

		if(!$post_id)
		{
			return false;
		}


		// $need_check = ['title', 'content', 'slug', 'seotitle', 'excerpt', 'specialaddress', 'url', 'status'];
		$need_check = ['slug', 'specialaddress', 'url', 'status'];

		foreach ($_data as $key => $value)
		{
			if(in_array($key, $need_check))
			{
				if(isset($_args[$key]))
				{
					if(!\dash\validate::is_equal($value, $_args[$key]))
					{
						$need_update = true;
					}
				}
			}
		}

		if($need_update)
		{
			\dash\utility\sitemap::posts($post_id);
		}
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

		$result = $_data;

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