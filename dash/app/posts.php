<?php
namespace dash\app;

class posts
{
	private static $raw_field = ['content'];
	public static $datarow = null;

	use \dash\app\posts\add;
	use \dash\app\posts\datalist;
	use \dash\app\posts\edit;
	use \dash\app\posts\get;


	public static function category_count()
	{
		$lang = \dash\language::current();
		$list = \dash\db\terms::category_count($lang);

		if(is_array($list))
		{
			foreach ($list as $key => $value)
			{
				$list[$key]['link'] = \dash\url::kingdom(). '/category/'. $value['url'];
			}
		}
		return $list;
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


	public static  function get_post_counter($_args)
	{
		$post_counter     = \dash\db\posts::get_post_counter($_args);
		if(is_array($post_counter))
		{
			$post_counter['all'] = array_sum($post_counter);
		}

		return $post_counter;
	}


	public static function lates_post($_args = [])
	{
		if(!isset($_args['limit']))
		{
			$_args['limit'] = 5;
			$_args['end_limit'] = 5;
		}

		$_args['order_raw'] = 'posts.id DESC';
		$_args['pagenation'] = false;
		$_args['status'] = 'publish';

		$list = \dash\db\posts::search(null, $_args);

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\posts', 'ready'], $list);
		}

		return $list;
	}


	public static function all_word_cloud($_args = [])
	{
		$word             = [];
		$myCount          = [];

		$allPost          = \dash\db\posts::get_words_chart($_args);

		$countAllPost     = count($allPost);

		if($countAllPost < 10)
		{
			$maxCountWord = 2;
		}
		elseif($countAllPost < 200)
		{
			$maxCountWord = 10;
		}
		else
		{
			$maxCountWord = 50;
		}

		if(is_array($allPost))
		{
			foreach ($allPost as $key => $value)
			{
				if(is_array($value))
				{
					foreach ($value as $k => $v)
					{
						$temp      = self::remove_2_char($v);
						$word[]    = $temp;
						$myCountTemp = array_count_values(explode(' ', $temp));
						foreach ($myCountTemp as $myWord => $myCountWord)
						{
							if($myCountWord > $maxCountWord)
							{
								if(isset($myCount[$myWord]))
								{
									$myCount[$myWord] = $myCount[$myWord] + $myCountWord;
								}
								else
								{
									$myCount[$myWord] = $myCountWord;
								}
							}
						}
					}
				}
			}
		}

		$result = [];
		foreach ($myCount as $key => $value)
		{
			$result[] = ['name' => $key, 'weight' => floatval($value)];
		}

		$result = json_encode($result, JSON_UNESCAPED_UNICODE);

		return $result;
	}


	private static function remove_2_char($_text)
	{
		$word = [];
		$_text = strip_tags($_text);
		$_text = str_replace('[', ' ', $_text);
		$_text = str_replace(']', ' ', $_text);
		$_text = str_replace('{', ' ', $_text);
		$_text = str_replace('}', ' ', $_text);
		$_text = str_replace('"', ' ', $_text);
		$_text = str_replace('؛', ' ', $_text);
		$_text = str_replace("'", ' ', $_text);
		$_text = str_replace('(', ' ', $_text);
		$_text = str_replace(')', ' ', $_text);
		$_text = str_replace(':', ' ', $_text);
		$_text = str_replace(',', ' ', $_text);
		$_text = str_replace('،', ' ', $_text);
		$_text = str_replace('-', ' ', $_text);
		$_text = str_replace('_', ' ', $_text);
		$_text = str_replace('?', ' ', $_text);
		$_text = str_replace('؟', ' ', $_text);
		$_text = str_replace('.', ' ', $_text);
		$_text = str_replace('=', ' ', $_text);
		$_text = str_replace('
', ' ', $_text);

		$_text = str_replace("\n", ' ', $_text);
		$_text = str_replace('!', ' ', $_text);
		$_text = str_replace('&nbsp;', ' ', $_text);

		$split = explode(" ", $_text);

		foreach ($split as $key => $value)
		{
			$value = trim($value);
			if(mb_strlen($value) > 2 && !is_numeric($value))
			{
				$word[] = $value;
			}
		}

		$word = implode(' ', $word);
		$word = trim($word);
		return $word;
	}
	public static function home_chart($_args)
	{

		$home_chart = \dash\db\posts::home_chart();

		if(!is_array($home_chart))
		{
			$home_chart = [];
		}

		$categories = [];
		$values     = [];
		$hi_chart   = [];

		foreach ($home_chart as $key => $value)
		{
			if(array_key_exists('type', $value))
			{
				$categories[] = T_(ucfirst($value['type']));
			}

			if(array_key_exists('count', $value))
			{
				$values[] = floatval($value['count']);
			}
		}

		$hi_chart['categories'] = json_encode($categories, JSON_UNESCAPED_UNICODE);
		$hi_chart['value']      = json_encode($values, JSON_UNESCAPED_UNICODE);

		return $hi_chart;

	}


	public static function post_gallery($_post_id, $_file_detail, $_type = 'add')
	{
		$post_id = \dash\validate::code($_post_id);
		$post_id = \dash\coding::decode($post_id);
		if(!$post_id)
		{
			\dash\notif::error(T_("Invalid post id"));
			return false;
		}

		$load_post_meta = \dash\db\posts::get(['id' => $post_id, 'limit' => 1]);

		if(!array_key_exists('meta', $load_post_meta))
		{
			\dash\notif::error(T_("Invalid post id"));
			return false;
		}

		$meta = $load_post_meta['meta'];

		if(is_string($meta) && (substr($meta, 0, 1) === '{' || substr($meta, 0, 1) === '['))
		{
			$meta = json_decode($meta, true);
		}
		elseif(is_array($meta))
		{
			// no thing
		}
		else
		{
			$meta = [];
		}

		$post_gallery_field = isset($meta['gallery']) ? $meta['gallery'] : [];

		if($_type === 'add')
		{
			if(isset($_file_detail['path']))
			{
				$file_path = $_file_detail['path'];
			}
			else
			{
				\dash\notif::error(T_("File detail not found"));
				return false;
			}

			$fileid = isset($_file_detail['id']) ? $_file_detail['id'] : null;

			if(isset($post_gallery_field) && is_array($post_gallery_field) && isset($post_gallery_field['files']) && is_array($post_gallery_field['files']))
			{
				foreach ($post_gallery_field['files'] as $key => $one_file)
				{
					if(isset($one_file['path']) && $one_file['path'] === $file_path)
					{
						\dash\notif::error(T_("Duplicate file in this gallery"));
						return false;
					}
				}

				$post_gallery_field['files'][] = ['id' => $fileid, 'path' => $file_path];
			}
			else
			{
				$post_gallery_field['files']   = [];
				$post_gallery_field['files'][] = ['id' => $fileid, 'path' => $file_path];
			}


			// check max gallery image
			if(isset($post_gallery_field['files']) && is_array($post_gallery_field['files']))
			{
				if(count($post_gallery_field['files']) > 10)
				{
					\dash\notif::error(T_("Maximum count of gallery file is 10"));
					return false;
				}
			}
		}
		else
		{
			$fileid = $_file_detail; // the file id

			if(!$fileid)
			{
				\dash\notif::error(T_("Invalid file id"));
				return false;
			}

			if(isset($post_gallery_field['files']) && is_array($post_gallery_field['files']))
			{
				$find_in_gallery = false;
				$remove_file_id = null;
				foreach ($post_gallery_field['files'] as $key => $one_file)
				{
					if(isset($one_file['id']) && floatval($one_file['id']) === floatval($fileid))
					{
						$remove_file_id = $one_file['id'];
						$find_in_gallery = true;
						unset($post_gallery_field['files'][$key]);
					}
				}

				if(!$find_in_gallery)
				{
					\dash\notif::error(T_("Invalid gallery id"));
					return false;
				}
			}
		}

		$meta['gallery'] = $post_gallery_field;

		$meta = json_encode($meta, JSON_UNESCAPED_UNICODE);
		\dash\log::set('addPostGallery', ['code' => $post_id]);
		\dash\db\posts::update(['meta' => $meta], $post_id);
		return true;

	}



	public static function get_url()
	{
		$myUrl = \dash\url::directory();
		$myUrl = \dash\url::urlfilterer($myUrl);
		return $myUrl;
	}

	public static function check($_args, $_id = null, $_option = [])
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
			$publishtime = date("H:i");
		}

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


	public static function set_post_term($_post_id, $_type, $_related = 'posts', $_data = [])
	{

		$have_term_to_save_log = false;

		// set default
		if($_related === null)
		{
			$_related = 'posts';
		}

		$category = $_data;

		$check_all_is_cat = null;

		if(strpos($_type, 'tag') !== false)
		{
			$tag = $category;
			if(is_string($tag))
			{
				$tag = explode(',', $tag);
				$tag = array_filter($tag);
				$tag = array_unique($tag);
			}

			if(!is_array($tag))
			{
				$tag = [];
			}

			$check_exist_tag = \dash\db\terms::get_mulit_term_title($tag, $_type);

			$all_tags_id = [];

			$must_insert_tag = $tag;

			if(is_array($check_exist_tag))
			{
				$check_exist_tag = array_column($check_exist_tag, 'title', 'id');
				$check_exist_tag = array_filter($check_exist_tag);
				$check_exist_tag = array_unique($check_exist_tag);

				foreach ($check_exist_tag as $key => $value)
				{

					if(isset($value) && in_array($value, $tag))
					{
						unset($tag[array_search($value, $tag)]);
						unset($must_insert_tag[array_search($value, $must_insert_tag)]);
					}

					array_push($all_tags_id, floatval($key));
				}
			}

			$must_insert_tag = array_filter($must_insert_tag);
			$must_insert_tag = array_unique($must_insert_tag);

			if(!empty($must_insert_tag))
			{
				$multi_insert_tag = [];
				foreach ($must_insert_tag as $key => $value)
				{
					$slug = \dash\validate::slug($value, false);

					$multi_insert_tag[] =
					[
						'type'      => $_type,
						'status'    => 'enable',
						'title'     => $value,
						'slug'      => $slug,
						'url'       => $slug,
						'user_id'   => \dash\user::id(),
						'language'  => \dash\language::current(),

					];
				}
				$have_term_to_save_log = true;
				$first_id    = \dash\db\terms::multi_insert($multi_insert_tag);
				$all_tags_id = array_merge($all_tags_id, \dash\db\config::multi_insert_id($multi_insert_tag, $first_id));
			}

			$category_id = $all_tags_id;
		}
		else
		{
			$category_id = [];

			if($category && is_array($category))
			{
				$category_id = array_map(function($_a){return \dash\coding::decode($_a);}, $category);
				$category_id = array_filter($category_id);
				$category_id = array_unique($category_id);
				if($category_id)
				{
					$check_all_is_cat = \dash\db\terms::check_multi_id($category_id, $_type);
					if(is_array($check_all_is_cat) && is_array($category_id))
					{
						if(count($check_all_is_cat) !== count($category_id))
						{
							\dash\notif::warn(T_("Some :type is wrong", ['type' => T_($_type)]), 'cat');
							return false;
						}
					}
				}
			}
		}

		$get_old_post_cat = \dash\db\termusages::usage($_post_id, $_type, $_related);

		$must_insert = [];
		$must_remove = [];

		if(empty($get_old_post_cat))
		{
			$must_insert = $category_id;
		}
		else
		{
			$old_category_id = array_column($get_old_post_cat, 'id');
			$old_category_id = array_map(function($_a){return floatval($_a);}, $old_category_id);
			$must_insert = array_diff($category_id, $old_category_id);
			$must_remove = array_diff($old_category_id, $category_id);
		}

		if(!empty($must_insert))
		{
			$insert_multi = [];
			foreach ($must_insert as $key => $value)
			{
				$insert_multi[] =
				[
					'term_id'    => $value,
					'related_id' => $_post_id,
					'related'    => $_related,
					'type'       => $_type,
				];
			}
			if(!empty($insert_multi))
			{
				$have_term_to_save_log = true;
				\dash\db\termusages::insert_multi($insert_multi);
			}
		}

		if($_type === 'cat')
		{
			// j([$must_remove, $must_insert]);
		}

		if(!empty($must_remove))
		{
			$must_remove = array_filter($must_remove);
			$must_remove = array_unique($must_remove);

			$must_remove = implode(',', $must_remove);

			\dash\log::set('removePostTerm', ['code' => $_type, 'datalink' => \dash\coding::encode($_post_id)]);
			\dash\db\termusages::hard_delete(['related_id' => $_post_id, 'related' => $_related, 'term_id' => ["IN", "($must_remove)"]]);
		}


		$new_url = null;

		if($check_all_is_cat)
		{
			$new_url = isset($check_all_is_cat[0]['url']) ? $check_all_is_cat[0]['url'] : null;
		}

		if($have_term_to_save_log)
		{
			\dash\log::set('setPostTerm', ['code' => $_type]);
		}

		return $new_url;


	}

	public static function find_post()
	{
		$url = self::get_url();

		if(substr($url, 0, 7) == 'static/' || substr($url, 0, 6) == 'files/' || substr($url, 0, 7) == 'static_' || substr($url, 0, 6) == 'files_')
		{
			return false;
		}

		if(file_exists(\dash\engine\content::get_addr(). "template/static/$url.html"))
		{
			return false;
		}

		$url = str_replace("'", '', $url);
		$url = str_replace('"', '', $url);
		$url = str_replace('`', '', $url);
		$url = str_replace('%', '', $url);

		$language = \dash\language::current();
		$preview  = \dash\request::get('preview');

		// load attachments
		// if(substr($url, 0, 6) === 'image/' || substr($url, 0, 6) === 'video/' )
		// {
		// 	$datarow = \dash\db\posts::get(['url' => $url, 'limit' => 1]);
		// }
		// else
		// {
			$datarow = \dash\db\posts::get(['language' => $language, 'url' => $url, 'limit' => 1]);
		// }

		if(isset($datarow['user_id']) && (int) $datarow['user_id'] === (int) \dash\user::id())
		{
			// no problem to load this post
		}
		else
		{
			if($preview)
			{
				// no problem to load this post
			}
			else
			{
				if(isset($datarow['status']) && $datarow['status'] == 'publish')
				{
					// no problem to load this poll
				}
				else
				{
					$datarow = false;
				}
			}
		}

		// we have more than one record
		if(isset($datarow[0]))
		{
			$datarow = false;
		}

		if(isset($datarow['id']))
		{
			$id = $datarow['id'];
		}
		else
		{
			$datarow = false;
			$id  = 0;
		}

		if(is_array($datarow))
		{
			$datarow = self::ready($datarow);
		}

		self::$datarow = $datarow;

		return $datarow;
	}


	public static function ready_row($_data)
	{
		return self::ready($_data, false);
	}

	/**
	 * ready data of classroom to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data, $_load_parent = true)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'parent':
					if(isset($value))
					{
						if($_load_parent)
						{
							$parent_detail  = \dash\db\posts::get(['id' => $value, 'limit' => 1]);

							$myParentDetail = [];

							if(isset($parent_detail['title']))
							{
								$myParentDetail['title'] = $parent_detail['title'];
							}

							if(isset($parent_detail['slug']))
							{
								$myParentDetail['slug'] = $parent_detail['slug'];
							}

							if(isset($parent_detail['url']))
							{
								$myParentDetail['url'] = $parent_detail['url'];
							}

							if(!empty($myParentDetail))
							{
								$result['parent_detail'] = $myParentDetail;
							}
						}

						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}

					break;
				case 'id':
				case 'user_id':
				case 'term_id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'meta':
					$result['meta'] = null;
					if(is_array($value))
					{
						$result['meta'] = $value;
					}
					elseif(is_string($value))
					{
						$result['meta'] = json_decode($value, true);
						if(!is_array($result['meta']))
						{
							$result['meta'] = [];
						}
					}

					$result['file'] = self::makeFileAddr($result['meta']);
					if(isset($result['meta']['thumb']))
					{
						$result['meta']['thumb'] = \lib\filepath::fix($result['meta']['thumb']);
					}

					if(isset($result['meta']['gallery']['files']) && is_array($result['meta']['gallery']['files']))
					{
						foreach ($result['meta']['gallery']['files'] as $Gkey => $Gvalue)
						{
							if(isset($Gvalue['path']))
							{
								$result['meta']['gallery']['files'][$Gkey]['path'] = \lib\filepath::fix($result['meta']['gallery']['files'][$Gkey]['path']);
							}

						}
					}


					break;

				case 'slug':
					$result[$key] = $value;
					$split = explode('/', $value);
					$parent_url = [];
					$my_parent_url = [];
					if(count($split) > 1)
					{
						foreach ($split as $index => $parent_slug)
						{
							$parent_url[] = $parent_slug;
							$my_parent_url[] = implode('/', $parent_url);
						}

						array_pop($my_parent_url);
					}

					$result['slug_raw']   = end($split);
					$result['parent_url'] = $my_parent_url;
					break;

				case 'url':
					$result[$key] = $value;
					break;

				case 'thumb':
					if($value)
					{
						$value = \lib\filepath::fix($value);
					}
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		if(isset($result['slug']))
		{
			$my_link = \dash\url::kingdom(). '/';
			if(isset($result['type']) && $result['type'] === 'help')
			{
				$my_link .= 'support/';
			}
			$my_link .= $result['slug'];

			$result['link'] = $my_link;
		}
		else
		{
			$result['link'] = null;
		}


		return $result;
	}

	private static function makeFileAddr($_meta)
	{
		if(!isset($_meta['thumb']))
		{
			return null;
		}

		$thumb = $_meta['thumb'];
		if(!$thumb)
		{
			return null;
		}

		$thumb = \lib\filepath::fix($thumb);
		$file_addr = substr($thumb, 0, strrpos($thumb, '.'));
		$ext       = str_replace($file_addr, '', $thumb);
		$files =
		[
			'main'   => $thumb,
			'large'  => $file_addr. '-large'. $ext,
			'normal' => $file_addr. '-normal'. $ext,
			'thumb'  => $file_addr. '-thumb'. $ext,
		];

		return $files;
	}


	public static function remove_thumb($_id)
	{
		$detail = \dash\app\posts::get($_id);
		if(!$detail)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		if(isset($detail['meta']))
		{
			$meta = $detail['meta'];
		}
		else
		{
			$meta = null;
		}


		if(is_array($meta))
		{
			unset($meta['thumb']);
			$meta = json_encode($meta, JSON_UNESCAPED_UNICODE);
		}
		else
		{
			$meta = null;
		}

		\dash\db\posts::update(['meta' => $meta], \dash\coding::decode($_id));
		\dash\notif::ok(T_("The Featured Image removed"));
		return true;

	}
}
?>