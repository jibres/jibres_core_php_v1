<?php
namespace dash\app\posts;


class check
{
	public static function variable($_args, $_id = null, $_option = [])
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
			'comment'         => 'bit',
			'status'          => ['enum' => ['publish','draft']],
			'parent'          => 'code',
			'publishdate'     => 'date',
			'publishtime'     => 'time',
			'icon'            => 'string_50',
			'redirecturl'     => 'url',
			'creator'         => 'code',
			'tag'             => 'tag',
			'cat'             => 'cat',
			'set_publishdate' => 'bit',
		];

		$require = ['title', 'slug'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['language'])
		{
			$data['language'] = \dash\language::current();
		}

		$default_option =
		[
			'meta'     => [],
			'raw_args' => [],
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

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
		}

		if(!$data['type'])
		{
			if(isset($current_post_detail['type']))
			{
				$data['type'] = $current_post_detail['type'];
			}
			else
			{
				$data['type'] = 'post';
			}
		}

		$isPage = false;
		$isHelp = false;
		$isPost = false;

		if(isset($current_post_detail['type']))
		{
			switch ($current_post_detail['type'])
			{
				case 'page': $isPage = true; break;
				case 'post': $isPost = true; break;
				case 'help': $isHelp = true; break;
			}
		}
		elseif($data['type'])
		{
			switch ($data['type'])
			{
				case 'page': $isPage = true; break;
				case 'post': $isPost = true; break;
				case 'help': $isHelp = true; break;
			}
		}


		if($isPage || $isHelp)
		{
			if($data['title'] && !$data['slug'])
			{
				$data['slug'] = $data['title'];
			}

			if($data['slug'])
			{
				$data['slug'] = \dash\validate::slug($data['slug'], false, ['rules' => 'persian']);
				$data['slug'] = str_replace(substr($data['slug'], 0, strrpos($data['slug'], '/')). '/', '', $data['slug']);
			}
		}

		$comment = $data['comment'];
		$comment = $comment ? 'open' : 'closed';


		$parent_url  = null;
		$parent_slug = null;

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
		}

		if($parent && ($isPage || $isHelp))
		{

			$parent_detail = \dash\db\posts\get::by_id($parent);

			if(!isset($parent_detail['slug']) || !isset($parent_detail['url']))
			{
				\dash\notif::error(T_("Parent post not found"), 'parent');
				return false;
			}

			if($_id)
			{
				if(floatval($parent) === floatval($_id))
				{
					\dash\notif::error(T_("Can not set page as parent of self!"), 'parent');
					return false;
				}

				if(isset($current_post_detail['parent']) && floatval($current_post_detail['parent']) !== floatval($parent))
				{
					$current_post_parent_detail = \dash\db\posts\get::by_id($current_post_detail['parent']);

					if(isset($current_post_parent_detail['slug']) && isset($current_post_parent_detail['url']))
					{
						$slug = str_replace($current_post_parent_detail['slug']. '-', '', $data['slug']);
						$url = str_replace($current_post_parent_detail['url']. '/', '', $data['url']);

						$parent_slug = $parent_detail['slug'];
						$parent_url = $parent_detail['url'];
					}
				}
				else
				{
					// no change in slug or url
					$parent_slug = $parent_detail['slug'];
					$parent_url = $parent_detail['url'];
				}

			}
			else
			{
				$parent_slug = $parent_detail['slug'];
				$parent_url = $parent_detail['url'];
			}
		}
		else
		{
			// unset parent for post record
			$data['parent'] = null;
		}


		if($parent_slug)
		{
			$data['slug'] = $parent_slug . '/'. $data['slug'];
		}

		if($parent_url)
		{
			$data['url'] = $parent_url . '/'. $data['url'];
		}

		if(isset($data['url']))
		{
			$check_duplicate_url_in_posts = \dash\db\posts\get::check_duplicate_url_in_posts($data['url'], $_id);
			if(isset($check_duplicate_url_in_posts['id']))
			{
				\dash\notif::error(T_("Duplicate post url. This post url is already exists in your post list"));
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

		$meta = $_option['meta'];


		$icon = $data['icon'];
		if($icon)
		{
			$meta['icon'] = $icon;
		}

		$meta['redirect'] = $data['redirecturl'];

		$meta = json_encode($meta, JSON_UNESCAPED_UNICODE);

		$data['meta'] = $meta;

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


		if($data['url'])
		{
			if(!\dash\validate\url::allow_post_url($data['url'], 'posts', $_id))
			{
				return false;
			}
		}

		if(!\dash\permission::check('cmsPostPublisher'))
		{
			unset($data['status']);
		}

		if(!$data['excerpt'] && $data['content'])
		{
			if(isset($current_post_detail['excerpt']) && $current_post_detail['excerpt'])
			{
				$data['excerpt'] = $current_post_detail['excerpt'];
			}
			else
			{
				$data['excerpt'] = \dash\utility\excerpt::extractRelevant($data['content']);
			}
		}

		if(mb_strlen($data['excerpt']) > 300)
		{
			$data['excerpt'] = substr($data['excerpt'], 0, 300);
		}

		if(!$data['status'])
		{
			$data['status'] = 'draft';
		}


		unset($data['redirecturl']);
		unset($data['publishtime']);
		unset($data['creator']);
		unset($data['icon']);


		return $data;

	}


	public static function get_user_can_write_post($_type)
	{
		$who_have = \dash\permission::who_have('cmsAddNewPost');
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


	public static function check_duplicate_post_and_term($_url, $_id, $_type)
	{
		if($_type === 'in_post')
		{
			$check_duplicate_url_in_posts = \dash\db\posts\get::check_duplicate_url_in_posts($_url, $_id);
			if(isset($check_duplicate_url_in_posts['id']))
			{
				\dash\notif::error(T_("Duplicate post url. This post url is already exists in your post list"));
				return false;
			}

			$check_duplicate_url_in_terms = \dash\db\terms\get::check_duplicate_url_in_terms($_url);

			if(isset($check_duplicate_url_in_terms['id']))
			{
				\dash\notif::error(T_("Duplicate url. You have a category by this url and can not set this url for post"));
				return false;
			}


		}
		else
		{
			// in category

			$check_duplicate_url_in_terms = \dash\db\terms\get::check_duplicate_url_in_terms($_url, $_id);
			if(isset($check_duplicate_url_in_terms['id']))
			{
				\dash\notif::error(T_("Duplicate category url. This category url is already exists in your category list"));
				return false;
			}

			$check_duplicate_url_in_posts = \dash\db\posts\get::check_duplicate_url_in_posts($_url);

			if(isset($check_duplicate_url_in_posts['id']))
			{
				\dash\notif::error(T_("Duplicate url. You have a post by this url and can not set this url for category"));
				return false;
			}
		}

		return true;
	}

}
?>