<?php
namespace dash\app\posts;


class check
{
	public static function variable($_args, $_id = null)
	{
		$condition =
		[
			'language'        => 'language',
			'cover'           => 'string_500', // path
			'thumb'           => 'string_500', // path
			'title'           => 'string_100',
			'seotitle'        => 'seotitle',
			'excerpt'         => 'string_300',
			'subtitle'        => 'string_500',
			'slug'            => 'string_100',
			'url'             => 'url',
			'content'         => 'html',
			'type'            => ['enum' => ['post', 'page', 'help', 'mag']],
			'subtype'         => ['enum' => ['standard', 'gallery', 'video', 'audio']],
			'status'          => ['enum' => ['publish','draft']],
			'specialaddress'  => ['enum' => ['independence', 'special', 'under_tag', 'under_page']],

			'comment'         => ['enum' => ['open','closed','default']],
			'showwriter'      => ['enum' => ['visible','hidden','default']],
			'showdate'        => ['enum' => ['visible','hidden','default']],

			'parent'          => 'code',
			'publishdate'     => 'date',
			'publishtime'     => 'time',
			'redirecturl'     => 'url',
			'creator'         => 'code',
			'tagurl'          => 'code',
			'tags'            => 'tag',
			'set_publishdate' => 'bit',
			'set_seo'         => 'bit',
		];

		$require = ['title'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$current_post_detail            = [];
		$current_post_detail['user_id'] = null;
		$current_post_detail['type']    = null;
		$current_post_detail['status']  = null;

		if($_id)
		{
			$current_post_detail = \dash\db\posts\get::by_id($_id);

			if(!isset($current_post_detail['user_id']) || !isset($current_post_detail['status']) || !isset($current_post_detail['type']))
			{
				\dash\notif::error(T_("Invalid id"));
				return false;
			}


			if(!\dash\permission::check('cmsManageAllPost'))
			{
				if(floatval(\dash\user::id()) === floatval($current_post_detail['user_id']))
				{
					/* no problem*/
				}
				else
				{
					\dash\permission::deny(T_("Can not access to edit this post!"));
				}
			}
		}

		// all record is page
		$data['type']    = 'post';

		if(!$data['language'])
		{
			$data['language'] = \dash\language::current();
		}

		// default special address is independence
		if(!$data['specialaddress'])
		{
			$data['specialaddress'] = 'independence';
		}

		$need_slug = false;

		// independence post
		if($data['specialaddress'] === 'independence')
		{
			$need_slug      = false;
			$data['slug']   = null;
			$data['url']    = null;
			$data['parent'] = null;
			$data['tagurl'] = null;
		}
		elseif($data['specialaddress'] === 'special')
		{
			$need_slug      = true;
			$data['parent'] = null;
			$data['tagurl'] = null;
		}
		elseif($data['specialaddress'] === 'under_tag')
		{
			$need_slug      = true;
			$data['parent'] = null;

			if(!$data['tagurl'])
			{
				\dash\notif::error(T_("Please choose a tag"));
				return false;
			}
		}
		elseif($data['specialaddress'] === 'under_page')
		{
			$need_slug      = true;
			$data['tagurl'] = null;

			if(!$data['parent'])
			{
				\dash\notif::error(T_("Please choose a post as parent"));
				return false;
			}
		}

		if($need_slug)
		{
			if(!$data['slug'])
			{
				\dash\notif::error(T_("Url is required"), 'slug');
				return false;
			}
		}

		if($data['slug'])
		{
			$data['slug'] = \dash\validate::slug($data['slug'], false, ['rules' => 'persian']);
			$data['slug'] = str_replace(substr($data['slug'], 0, strrpos($data['slug'], '/')). '/', '', $data['slug']);
		}

		if($data['slug'] && $data['specialaddress'] === 'special')
		{
			$data['url'] = $data['slug'];
		}


		$parent = $data['parent'];

		if($parent)
		{
			$parent = \dash\coding::decode($parent);

			if(!$parent)
			{
				\dash\notif::error(T_("Invalid parameter parent"), 'parent');
				return false;
			}

			$data['parent'] = $parent;

			$parent_detail = \dash\db\posts\get::by_id($parent);

			if(isset($parent_detail['specialaddress']) && $parent_detail['specialaddress'] === 'special')
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Only post by special address can set as parent of another post"));
				return false;
			}

			if(!isset($parent_detail['slug']) || !isset($parent_detail['url']))
			{
				\dash\notif::error(T_("Parent post have not a special url"), 'parent');
				return false;
			}

			if($_id && floatval($parent) === floatval($_id))
			{
				\dash\notif::error(T_("Can not set page as parent of self!"), 'parent');
				return false;
			}

			$data['url'] = $parent_detail['url'] . '/'. $data['slug'];

		}
		else
		{
			// unset parent for post record
			$data['parent'] = null;
		}


		if($data['tagurl'])
		{
			$load_tag = \dash\app\terms\get::get($data['tagurl']);

			if(!$load_tag || !isset($load_tag['url']))
			{
				\dash\notif::error(T_("Invalid tag id"));
				return false;
			}

			$data['url'] = $load_tag['url'];
			$data['url'] .= '/'. $data['slug'];

		}


		if(isset($data['url']))
		{
			$check_duplicate_url_in_posts = \dash\db\posts\get::check_duplicate_url_in_posts($data['url'], $_id);
			if(isset($check_duplicate_url_in_posts['id']))
			{
				\dash\notif::error(T_("Duplicate post url. This post url is already exists in your post list"));
				return false;
			}

			if(!\dash\validate\url::allow_post_url($data['url'], 'posts', $_id))
			{
				return false;
			}
		}


		$publishdate = $data['publishdate'];

		if(!$publishdate && $data['status'] === 'publish')
		{
			$publishdate = date("Y-m-d");
		}

		$publishtime = $data['publishtime'];

		if(!$publishtime && $data['status'] === 'publish')
		{
			$publishtime = date("H:i:s");
		}

		$data['publishdate'] = trim($publishdate. ' '. $publishtime);

		if(isset($current_post_detail['publishdate']) && $current_post_detail['publishdate'])
		{
			if(!$data['set_publishdate'])
			{
				unset($data['publishdate']);
			}
		}

		unset($data['set_publishdate']);

		// only a person who can change all post can change the post writer
		if(\dash\permission::check('cmsManageAllPost'))
		{
			$creator = $data['creator'];

			if($creator && isset($current_post_detail['type']) && isset($current_post_detail['user_id']))
			{
				if(floatval(\dash\coding::decode($creator)) !== floatval($current_post_detail['user_id']))
				{
					$can_change = self::get_user_can_write_post($current_post_detail['type']);
					if(is_array($can_change))
					{
						$can_change = array_column($can_change, 'id');
						if(!in_array($creator, $can_change))
						{
							\dash\notif::error(T_("Invalid user"));
							return false;
						}
						$data['user_id'] = \dash\coding::decode($creator);
					}
				}
			}
		}

		if(!$data['subtype'])
		{
			$data['subtype'] = 'standard';
		}

		if(!$data['status'])
		{
			$data['status'] = 'draft';
		}

		if($data['slug'] && mb_strlen($data['slug']) > 100)
		{
			\dash\notif::error(T_("Can not set the slug larger than 100 character"), 'slug');
			return false;
		}

		if($data['url'] && mb_strlen($data['url']) > 180)
		{
			\dash\notif::error(T_("Can not set the url larger than 180 character"), 'url');
			return false;
		}

		if($data['status'] && $data['status'] === 'publish')
		{
			\dash\permission::access('cmsPostPublisher');
		}

		unset($data['publishtime']);
		unset($data['creator']);
		unset($data['tagurl']);
		unset($data['set_seo']);


		return $data;

	}


	public static function get_user_can_write_post($_type)
	{
		$who_have = \dash\permission::who_have('cmsManagePost');
		if(\dash\permission::supervisor())
		{
			$who_have[] = 'supervisor';
		}

		$load_user = \dash\db\users::get_by_permission($who_have);
		if(is_array($load_user))
		{
			$load_user = array_map(['\\dash\\app\\user', 'ready'], $load_user);
		}

		return $load_user;
	}



}
?>