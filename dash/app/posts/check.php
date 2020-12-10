<?php
namespace dash\app\posts;


class check
{



	public static function variable($_args, $_id = null, $_option = [])
	{
		$condition =
		[
			'language'    => 'language',
			'title'       => 'string_100',
			'seotitle'    => 'seotitle',
			'excerpt'     => 'string_300',
			'subtitle'    => 'string_500',
			'slug'        => 'string_100',
			'url'         => 'url',
			'content'     => 'html',
			'type'        => ['enum' => ['post', 'page', 'help', 'mag']],
			'comment'     => 'bit',
			'count'       => 'int',
			'order'       => 'int',
			'special'     => 'string',
			'status'      => ['enum' => ['publish','draft','schedule','deleted','expire']],
			'parent'      => 'code',
			'publishdate' => 'date',
			'publishtime' => 'time',
			'thumb'       => 'string',

			'icon'        => 'string_50',
			'btntitle'    => 'string_50',
			'btnurl'      => 'url',
			'btntarget'   => 'bit',
			'btncolor'    => ['enum' => ['primary','primary2','secondary','secondary2','success','success2','danger','danger2','warning','warning2','info','info2','light','dark','pain']],
			'srctitle'    => 'title',
			'srcurl'      => 'url',
			'redirecturl' => 'url',
			'creator'     => 'code',
			'tag'         => 'tag',
			'subtype'     => ['enum' => ['standard','image', 'gallery', 'video', 'audio']],


		];


		$require = ['title'];

		$meta =	[];


		$cat = isset($_args['cat']) ? $_args['cat'] : [];

		unset($_args['cat']);

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

			$current_post_detail = \dash\db\posts::get(['id' => $_id, 'limit' => 1]);
			if(!isset($current_post_detail['user_id']) || !isset($current_post_detail['status']) || !isset($current_post_detail['type']))
			{
				\dash\notif::error(T_("Invalid id"));
				return false;
			}

			if($current_post_detail['status'] === 'publish')
			{
				switch ($current_post_detail['type'])
				{
					case 'help':
						if(!\dash\permission::check('cpHelpCenterEditPublished'))
						{
							\dash\notif::error(T_("This help center is published. And you can not edit it!"));
							return false;
						}
						break;

					case 'post':
					case 'page':
					default:
						if(!\dash\permission::check('cpPostsEditPublished'))
						{
							\dash\notif::error(T_("This post is published. And you can not edit it!"));
							return false;
						}

						break;
				}
			}


			if(floatval($current_post_detail['user_id']) !== floatval(\dash\user::id()))
			{
				switch ($current_post_detail['type'])
				{
					case 'help':
						if(!\dash\permission::check('cpHelpCenterEditForOthers'))
						{
							\dash\notif::error(T_("This is not your post. And you can not edit it!"));
							return false;
						}
						break;

					case 'post':
					case 'page':
					default:
						if(!\dash\permission::check('cpPostsEditForOthers'))
						{
							\dash\notif::error(T_("This is not your post. And you can not edit it!"));
							return false;
						}
						break;
				}
			}
		}


		if($data['title'] && !$data['slug'])
		{
			$data['slug'] = $data['title'];
		}

		if($data['slug'])
		{
			$data['slug'] = \dash\validate::slug($data['slug'], false, ['rules' => 'persian']);
			$data['slug'] = str_replace(substr($data['slug'], 0, strrpos($data['slug'], '/')). '/', '', $data['slug']);
		}



		$check_duplicate_args = ['slug' => $data['slug'], 'language' => $data['language'], 'limit' => 1];


		$check_duplicate_slug = \dash\db\posts::get($check_duplicate_args);
		if(isset($check_duplicate_slug['id']))
		{
			if(floatval($check_duplicate_slug['id']) === floatval($_id))
			{
				// no problem to edit it
			}
			else
			{
				\dash\notif::error(T_("Duplicate slug"), 'slug');
				return false;
			}
		}

		if(!$data['url'])
		{
			$data['url'] = $data['slug'];
		}

		if(!$data['type'])
		{
			$data['type'] = 'post';
		}

		$comment = $data['comment'];
		$comment = $comment ? 'open' : 'closed';

		$special = $data['special'];

		if($special && !\dash\app\posts\special::check($special))
		{
			\dash\notif::error(T_("Invalid parameter special"), 'special');
			return false;
		}

		$status = $data['status'];

		if($status === 'deleted')
		{
			switch ($current_post_detail['type'])
			{
				case 'help':
					if(!\dash\permission::check('cpHelpCenterDelete'))
					{
						\dash\notif::error(T_("You can not delete help center"));
						return false;
					}
					break;

				case 'page':
					if(!\dash\permission::check('cpPageDelete'))
					{
						\dash\notif::error(T_("You can not delete page"));
						return false;
					}


				case 'post':
				default:
					if(!\dash\permission::check('cpPostsDelete'))
					{
						\dash\notif::error(T_("You can not delete post"));
						return false;
					}
					break;
			}

			if(floatval($current_post_detail['user_id']) !== floatval(\dash\user::id()))
			{
				switch ($current_post_detail['type'])
				{
					case 'help':
						if(!\dash\permission::check('cpHelpCenterDeleteForOthers'))
						{
							\dash\notif::error(T_("This is not your help center. And you can not delete it!"));
							return false;
						}
						break;

					case 'post':
					case 'page':
					default:
						if(!\dash\permission::check('cpPostsDeleteForOthers'))
						{
							\dash\notif::error(T_("This is not your post. And you can not delete it!"));
							return false;
						}
						break;
				}
			}

		}

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

			$parent_detail = \dash\db\posts::get(['id' => $parent, 'limit' => 1]);
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
					$current_post_parent_detail = \dash\db\posts::get(['id' => $current_post_detail['parent'], 'limit' => 1]);

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


		if($parent_slug)
		{
			$data['slug'] = $parent_slug . '/'. $data['slug'];
		}

		if($parent_url)
		{
			$data['url'] = $parent_url . '/'. $data['url'];
		}

		$publishdate = $data['publishdate'];

		if(!$publishdate && $data['status'] === 'publish')
		{
			$publishdate = date("Y-m-d");
		}

		$publishtime = $data['publishtime'];

		if($data['status'] === 'publish' && !$publishtime)
		{
			$publishtime = date("H:i:s");
		}

		$data['publishdate'] = trim($publishdate. ' '. $publishtime);

		$meta = $_option['meta'];

		if($data['thumb'])
		{
			$meta['thumb'] = $data['thumb'];
		}

		if(isset($current_post_detail['type']))
		{
			$data['type'] = $current_post_detail['type'];
		}

		if(in_array($data['type'], ['post']))
		{
			if(!$cat)
			{
				\dash\notif::warn(T_("Category setting for better access is suggested"));
			}
		}


		$icon = $data['icon'];
		if($icon)
		{
			$meta['icon'] = $icon;
		}

		$btntitle    = $data['btntitle'];
		$btnurl      = $data['btnurl'];
		$btntarget   = $data['btntarget'] ? true : false;
		$btncolor    = $data['btncolor'];
		$srctitle    = $data['srctitle'];
		$srcurl      = $data['srcurl'];
		$redirecturl = $data['redirecturl'];

		$meta['download'] =
		[
			'title'  => $btntitle,
			'url'    => $btnurl,
			'target' => $btntarget,
			'color'  => $btncolor,
		];

		$meta['source'] =
		[
			'title' => $srctitle,
			'url'   => $srcurl,
		];

		$meta['redirect'] = $redirecturl;


		$meta = json_encode($meta, JSON_UNESCAPED_UNICODE);

		$data['meta'] = $meta;
		if(!$data['slug'])
		{
			\dash\notif::error(T_("Invalid slug"), 'slug');
			return false;
		}


		if(\dash\permission::check('cpChangePostCreator'))
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
			if(!\dash\app\url::check($data['url']))
			{
				return false;
			}
		}


		// check status
		switch ($current_post_detail['type'])
		{
			case 'help':
				if(!\dash\permission::check('cpHelpCenterEditStatus'))
				{
					unset($data['status']);
				}
				break;

			default:
				if(!\dash\permission::check('cpPostsEditStatus'))
				{
					unset($data['status']);
				}
				break;
		}

		if(!$data['excerpt'])
		{
			$data['excerpt'] = \dash\utility\excerpt::extractRelevant($data['content']);

		}

		if(mb_strlen($data['excerpt']) > 300)
		{
			$data['excerpt'] = substr($data['excerpt'], 0, 300);
		}

		if(!$data['status'])
		{
			$data['status'] = 'draft';
		}


		unset($data['btntitle']);
		unset($data['btnurl']);
		unset($data['btntarget']);
		unset($data['btncolor']);
		unset($data['srctitle']);
		unset($data['srcurl']);
		unset($data['redirecturl']);
		unset($data['publishtime']);
		unset($data['creator']);
		unset($data['tag']);
		unset($data['icon']);
		unset($data['thumb']);

		return $data;

	}

	public static function get_user_can_write_post($_type)
	{
		switch ($_type)
		{
			case 'page':
				$permission = 'cpPageAdd';
				break;

			case 'help':
				$permission = 'cpHelpCenterAdd';
				break;

			case 'post':
			default:
				$permission = 'cpPostsAdd';
				break;
		}

		$who_have = \dash\permission::who_have($permission);
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