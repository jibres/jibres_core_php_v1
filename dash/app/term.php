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


	public static function get_all_tag()
	{
		$list = \dash\db\terms::get_all_tag();
		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['self', 'ready'], $list);

		return $list;
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
			if(\dash\data::dataRow_id())
			{
				$args['post_id'] = \dash\data::dataRow_id();
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
				$tags = null;
				// $tags = \dash\app\posts::get_category_tag($args['post_id'], $type, $related);
				// \dash\temp::set($cache_key, $tags);
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


	// user in dashboard
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


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */





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