<?php
namespace dash\app;

/**
 * Class for user.
 */
class term
{
	public static $sort_field =
	[
		'title',
		'slug',
		'count',
		'type',
		'status',
	];

	public static function load_category_html()
	{
		$category = [];
		$args     = func_get_args();
		$class    = '';
		$type     = 'cat';

		if(isset($args[0]))
		{
			$args = $args[0];
		}

		if(isset($args['type']))
		{
			$type = $args['type'];
		}

		// get post id
		if(!isset($args['post_id']))
		{
			if(\dash\data::datarow_id())
			{
				$args['post_id'] = \dash\data::datarow_id();
			}
		}
		// get category
		if(isset($args['post_id']))
		{
			$category = \dash\app\posts::get_category_tag($args['post_id'], $type);
		}

		if(isset($args['id']) && $args['id'] && is_array($category))
		{
			$category = array_column($category, 'term_id');
		}

		if(isset($args['class']) && $args['class'])
		{
			$class = $args['class'];
		}

		if(isset($args['format']) && $args['format'])
		{
			$outputFormat = $args['format'];

			switch ($outputFormat)
			{
				case 'json':
					if(is_array($category))
					{
						$category = json_encode($category, JSON_UNESCAPED_UNICODE);
					}
					break;

				case 'csv':
					if(is_array($category))
					{
						$category = implode(',', $category);
					}
					break;

				case 'html':
					$html      = '';
					$baset_url = \dash\url::base();
					foreach ($category as $key => $value)
					{
						if(array_key_exists('url', $value) && isset($value['title']))
						{
							if($class)
							{
								$html .= "<a href='$baset_url/category/$value[url]' class='$class'>$value[title]</a>";
							}
							else
							{
								$html .= "<a href='$baset_url/category/$value[url]'>$value[title]</a>";
							}
						}
					}
					echo $html;
					// return and dont continue
					return;
					break;

				default:
					break;
			}
		}

		return $category;
	}



	public static function load_tag_html()
	{
		$tags      = [];
		$args      = func_get_args();
		$container = '';
		if(isset($args[0]))
		{
			$args = $args[0];
		}

		// get post id
		if(!isset($args['post_id']))
		{
			if(\dash\data::datarow_id())
			{
				$args['post_id'] = \dash\data::datarow_id();
			}
		}

		// get related
		$related = 'posts';
		if(isset($args['related']) && is_string($args['related']) && $args['related'])
		{
			$related = $args['related'];
		}

		$type = 'tag';
		if(isset($args['type']) && is_string($args['type']) && $args['type'])
		{
			$type = $args['type'];
		}

		// get tags
		if(isset($args['post_id']))
		{
			$cache_key = 'post_tag_'. $args['post_id'];
			if(\dash\temp::get($cache_key))
			{
				$tags = \dash\temp::get($cache_key);

			}
			else
			{
				$tags = \dash\app\posts::get_category_tag($args['post_id'], $type, $related);
				\dash\temp::set($cache_key, $tags);
			}
		}

		if(isset($args['title']) && $args['title'])
		{
			if(is_array($tags))
			{
				$tags = array_column($tags, 'title');
			}
		}

		if(isset($args['container']) && $args['container'])
		{
			$container = $args['container'];
		}


		if(isset($args['format']) && $args['format'])
		{
			$outputFormat = $args['format'];
			switch ($outputFormat)
			{
				case 'array':
					return $tags;
					break;

				case 'json':
					if(is_array($tags))
					{
						$tags = json_encode($tags, JSON_UNESCAPED_UNICODE);
					}
					break;

				case 'csv':
					if(is_array($tags))
					{
						$tags = implode(',', $tags);
					}
					break;

				case 'html':
				case 'html2':
					$html = '';
					if(is_array($tags) && $tags)
					{

						if($container)
						{
							$html = "<div class='$container'>";
						}

						foreach ($tags as $key => $value)
						{
							$baset_url = \dash\url::base();

							if($value['language'] !== \dash\language::primary())
							{
								$baset_url .= '/'. $value['language'];
							}

							if(array_key_exists('url', $value) && array_key_exists('slug', $value) && isset($value['title']))
							{
								if($outputFormat === 'html2')
								{
									$html .= "<span title='$value[slug]'>$value[title]</span>";
								}
								else
								{
									$html .= "<a href='$baset_url/tag/$value[url]'>$value[title]</a>";
								}
							}
						}
						// close container
						if($container)
						{
							$html .= '</div>';
						}
					}
					elseif(is_string($tags))
					{
						$html = $tags;
					}
					echo $html;
					// return and dont continue
					return;
					break;

				default:
					break;
			}

		}

		if($tags)
		{
			return $tags;
		}
	}


	public static function lates_term($_args = [])
	{
		if(!isset($_args['limit']))
		{
			$_args['limit'] = 5;
		}

		$_args['order_raw'] = 'terms.id DESC';
		$_args['pagenation'] = false;


		$list = \dash\db\terms::search(null, $_args);



		return $list;
	}

	public static function cat_list($_type = 'cat')
	{
		$check_arg = ['type' => $_type, 'language' => \dash\language::current(), 'status' => 'enable'];


		$result = \dash\db\terms::get($check_arg);
		$temp   = [];

		if(is_array($result))
		{
			foreach ($result as $key => $value)
			{
				$temp[] = self::ready($value);
			}
		}
		return $temp;
	}

	public static function get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}

		$args = ['id' => $id, 'limit' => 1];

		$result = \dash\db\terms::get($args);
		$temp = [];
		if(is_array($result))
		{
			$temp = self::ready($result);
		}
		return $temp;
	}
	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function check($_args, $_id = null)
	{

		$condition =
		[
			'title'    => 'title',
			'parent'   => 'code',
			'desc'     => 'desc',
			'status'   => ['enum' => ['enable','disable','expired','awaiting','filtered','blocked','spam','violence','pornography','other']],
			'slug'     => 'slug',
			'url'      => 'url',
			'type'     => ['enum' => ['tag', 'cat', 'code', 'other', 'help', 'term', 'support_tag', 'help_tag', 'category']],
			'language' => 'language',

		];


		$require = ['title'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if(!$data['slug'])
		{
			$data['slug'] = \dash\validate::slug($data['title'], false);
		}

		if($data['type'] === 'category')
		{
			$data['type'] = 'cat';
		}


		$check_duplicate_args = ['type' => $data['type'], 'slug' => $data['slug'], 'language' => $data['language'], 'limit' => 1];


		// check duplicate
		// type+lang+slug
		$check_duplicate = \dash\db\terms::get($check_duplicate_args);

		if(isset($check_duplicate['id']))
		{
			if(floatval($check_duplicate['id']) === floatval($_id))
			{
				// no problem to edit it
			}
			else
			{
				\dash\notif::error(T_("Duplicate term"), ['type', 'slug', 'language', 'title']);
				return false;
			}
		}





		$data['url'] = $data['slug'];

		if($data['type'] === 'cat')
		{
			if($data['parent'])
			{
				$data['parent'] = \dash\coding::decode($data['parent']);

				$get_parent = \dash\db\terms::get(['id' => $data['parent'], 'limit' => 1]);

				if(!isset($get_parent['id']) || !array_key_exists('type', $get_parent) || !array_key_exists('url', $get_parent))
				{
					\dash\notif::error(T_("Parent not found"), 'parent');
					return false;
				}

				if(floatval($get_parent['id']) === floatval($_id))
				{
					\dash\notif::error(T_("Can not set the parent as yourself"), 'parent');
					return false;
				}
				if($get_parent['type'] != $data['type'])
				{
					\dash\notif::error(T_("The parent is not a :type", ['type' => $data['type']]), 'parent');
					return false;
				}
				$data['url'] = $get_parent['url'] . '/'. $data['slug'];
				$data['url'] = ltrim($url, '/');
			}
		}



		if($data['url'])
		{
			if(!\dash\app\url::check($data['url']))
			{
				return false;
			}
		}

		return $data;
	}


	/**
	 * ready data of user to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'parent':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'type':
					if($value === 'cat')
					{
						$result[$key] = 'category';
					}
					else
					{
						$result[$key] = $value;
					}
					break;

				case 'url':
					if(isset($_data['type']))
					{
						if($_data['type'] === 'cat')
						{
							$result[$key] = 'category/'. $value;
						}
						else
						{
							$result[$key] = $_data['type'] . '/'. $value;
						}
					}
					else
					{
						$result[$key] = $value;
					}
					break;

				case 'meta':
					if($value && is_string($value))
					{
						$result[$key] = json_decode($value, true);
					}
					else
					{
						$result[$key] = $value;
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	/**
	 * add new user
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args, $_option = [])
	{


		$default_option =
		[
			'debug'    => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		if(!\dash\user::id())
		{
			if($_option['debug']) \dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = self::check($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$return  = [];

		if(!$args['status'])
		{
			$args['status'] = 'enable';
		}

		$term_id = \dash\db\terms::insert($args);

		if(!$term_id)
		{
			\dash\log::set('noWayToAddTerm');
			\dash\notif::error(T_("No way to insert term"));
			return false;
		}

		\dash\log::set('addTerm', ['code' => $term_id, 'datalink' => \dash\coding::encode($term_id)]);

		return $return;
	}

	public static function list($_string = null, $_args = [])
	{

		if(!\dash\user::id())
		{
			return false;
		}

		$default_args =
		[
			'order' => null,
			'sort'  => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$option = [];
		$option = array_merge($default_args, $_args);

		if($option['order'])
		{
			if(!in_array($option['order'], ['asc', 'desc']))
			{
				unset($option['order']);
			}
		}

		if($option['sort'])
		{
			if(!in_array($option['sort'], self::$sort_field))
			{
				unset($option['sort']);
			}
		}

		$field             = [];

		unset($option['in']);

		$result = \dash\db\terms::search($_string, $option, $field);

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}


	public static function edit($_args, $_id, $_option = [])
	{

		$default_option =
		[

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit term"), 'term');
			return false;
		}

		// check args
		$args = self::check($_args, $id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		\dash\db\terms::update($args, $id);

		\dash\log::set('editTerm', ['code' => $id, 'datalink' => \dash\coding::encode($id)]);

		return true;
	}
}
?>