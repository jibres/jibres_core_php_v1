<?php
namespace dash\app\terms;


class get
{
	public static function sitemap_list($_from, $_to)
	{
		$lang = null;
		if(!\dash\engine\store::inStore())
		{
			$lang = \dash\language::current();
		}

		$list = \dash\db\terms\get::sitemap_list($_from, $_to, $lang);

		if(!is_array($list) || !$list)
		{
			return null;
		}

		$list = array_map(['\\dash\\app\\terms\\ready', 'row'], $list);

		return $list;
	}

	public static function get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}

		$result = self::inline_get($id);

		if(!$result)
		{
			\dash\notif::error(T_("Terms not founded"));
			return false;
		}

		$result = \dash\app\terms\ready::row($result);

		return $result;
	}


	public static function inline_get($_id)
	{

		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$result = \dash\db\terms\get::by_id($_id);
		if(!$result || !is_array($result))
		{
			return false;
		}

		return $result;
	}


	public static function get_all_tag()
	{
		$list = \dash\db\terms\get::get_all_tag();
		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\dash\\app\\terms\\ready', 'row'], $list);

		return $list;
	}


	public static function cat_list()
	{
		$args =
		[
			'type' => 'cat',
			'pagination' => false,
		];
		return \dash\app\terms\search::list(null, $args);
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
}
?>