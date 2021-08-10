<?php
namespace content_site\section;


class view
{
	/**
	 * { var_description }
	 *
	 * @var        array
	 */
	private static $remove_needless_get =
	[
		'index'   => null,
		'section' => null,
		'list'    => null,
	];



	public static function config()
	{
		\content_site\view::fill_page_detail();


		// in a section
		if(\dash\url::child())
		{
			// \content_site\controller::load_current_section_list();
			self::generate_back_url();
		}
		else
		{
			// add new section
			\dash\face::title(T_('Add new Section'));
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::here(). '/page'. \dash\request::full_get(self::$remove_needless_get));
		}

		// load section list if needed
		self::show_section_preview_in_group();

	}


	/**
	 * Generate back url
	 *
	 * force remove index and sid in GET
	 *
	 * remove last directory of url
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function generate_back_url()
	{
		\dash\data::back_text(T_('Back'));

		$dir = \dash\url::dir();
		array_pop($dir);

		if(count($dir) >= 2)
		{
			$url = \dash\url::here(). '/';
			$url .= implode('/', $dir);
			$url .= \dash\request::full_get(self::$remove_needless_get);
		}
		else
		{
			$url = \dash\url::here();
			$url .= '/page';
			$url .= \dash\request::full_get(array_merge(self::$remove_needless_get, ['sid' => null]));
		}

		\dash\data::back_link($url);
		return $url;
	}


	/**
	 * Shows the section in group.
	 */
	private static function show_section_preview_in_group()
	{
		$folder            = \dash\validate::string_100(\dash\request::get('folder'));

		if(!$folder)
		{
			$folder = 'body';
		}

		$section_requested = \dash\validate::string_100(\dash\request::get('section'));
		$category    = \dash\validate::string_100(\dash\request::get('category'));

		if(\dash\url::child())
		{
			if(\dash\data::changeSectionTypeMode())
			{
				$folder            = \dash\data::currentSectionDetail_mode();
				$section_requested = \dash\url::child();
			}
			else
			{
				// needless to load preview key
				return;
			}
		}

		$section_list = controller::section_list();

		$sidebar_list             = [];
		$group_list               = [];
		$preview_list             = [];
		$section_requested_detail = [];

		foreach ($section_list as $key => $value)
		{
			$mode = \content_site\call_function::get_folder(a($value, 'key'));

			if($folder && $folder !== $mode)
			{
				continue;
			}

			if($section_requested)
			{
				if(a($value, 'key') === $section_requested)
				{
					$section_requested_detail = \content_site\call_function::detail($value['key']);

					$category_list = \content_site\call_function::category($value['key']);

					// replace sidebar_list
					$sidebar_list = $category_list;

					if($category)
					{
						$load_preview_list = \content_site\call_function::preview_list($value['key'], $category);
					}
					else
					{
						$load_preview_list = \content_site\call_function::preview_list($value['key']);
					}

					// filter by preview requested
					if(!$load_preview_list)
					{
						continue;
					}

					$preview_list = $load_preview_list;
				}
				else
				{
					// skip section by other key
					continue;
				}
			}
			else
			{
				// show all group
				if(!isset($group_list[a($value, 'group')]))
				{
					$group_list[a($value, 'group')] = [];
				}

				$group_list[a($value, 'group')][] = $value;
			}
		}

		if($section_requested)
		{
			\dash\data::include_adminPanelBuilder(true);
		}

		// save sidebar_list to show in dispaly
		\dash\data::groupSectionList($group_list);
		\dash\data::sidebarSectionList($sidebar_list);
		\dash\data::previewSectionList($preview_list);
		\dash\data::sectionRequestedDetail($section_requested_detail);

		$all_get = \dash\request::get();

		if($folder && $section_requested && $category)
		{
			\dash\face::title(\dash\face::title() . ' | '. $section_requested . ' | '. $category);
			unset($all_get['category']);
			unset($all_get['section']);
		}
		elseif($folder && $section_requested && !$category)
		{
			\dash\face::title(\dash\face::title() . ' | '. $section_requested);
			unset($all_get['section']);
		}

		\dash\data::back_text(T_('Back'));

		if($section_requested)
		{
			$url = \dash\url::this(). '?'.\dash\request::build_query($all_get);
		}
		else
		{
			$url = \dash\url::here();
			$url .= '/page';
			$url .= '?'.\dash\request::build_query(['id' => \dash\request::get('id')]);
			// $url = \dash\url::this(). '?'.\dash\request::build_query($all_get);
		}

		\dash\data::back_link($url);

		// var_dump($result);exit;
	}


	/**
	 * Gets the current index detail from preview
	 *
	 * if in a child index (for example in a file of gallery) return index of this
	 * else return index of preview array
	 *
	 */
	public static function get_current_index_detail($_need = null)
	{
		$subchild = \dash\url::subchild();
		$index = \dash\request::get('index');

		$detail = [];

		$preview = \dash\data::currentSectionDetail_preview();

		if($subchild && $index)
		{
			if(isset($preview[$subchild]) && is_array($preview[$subchild]))
			{
				foreach ($preview[$subchild] as $key => $value)
				{
					if(isset($value['index']) && $value['index'] === $index)
					{
						$detail = $value;
					}
				}
			}
		}
		// elseif($subchild)
		// {
		// 	$detail = a($preview, $subchild);
		// }
		else
		{
			$detail = $preview;
		}

		if($_need)
		{
			return a($detail, $_need);
		}

		return $detail;
	}


	/**
	 * Ready section detail for show
	 *
	 * @param      <type>  $_data  The data
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	public static function ready_section_list($_data, $_generate_layout = false)
	{
		$result = [];

		$section_key = null;

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'body':
				case 'preview':
					if(is_string($value))
					{
						$value = json_decode($value, true);
					}

					if(!is_array($value))
					{
						$value = [];
					}

					$result[$key] = $value;

					if(isset($value['key']) && is_string($value['key']))
					{
						$section_key = $value['key'];
					}

					break;

				// hide this field
				case 'duplicate':
				case 'titlesetting':
				case 'background':
				case 'avand':
				case 'margin':
				case 'padding':
				case 'radius':
				case 'ratio':
				case 'meta':
				case 'ifloginshow':
				case 'ifpermissionshow':
				case 'type':
				case 'puzzle':
				case 'infoposition':
				case 'effect':
				case 'detail':
				case 'text':
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		if(is_array(a($result, 'body')) && $result['body'] && is_array(a($result, 'preview')) && $result['preview'])
		{
			$changelog = self::array_recursive_diff($result['preview'], $result['body']);
			if($changelog)
			{
				$result['discardable'] = true;
				$result['changelog']   = $changelog;
			}
		}

		$default = [];

		$detail  = [];

		$detail = \content_site\call_function::detail($section_key);

		if(!is_array($detail))
		{
			$detail = [];
		}

		$default = \content_site\call_function::default($section_key, a($result, 'preview', 'type'));

		if(!is_array($default))
		{
			$default = [];
		}

		$options = \content_site\call_function::option($section_key, a($result, 'preview', 'type'));

		$default_options = [];

		if(is_array($options))
		{
			foreach ($options as $option_name)
			{
				if(is_string($option_name))
				{
					$default_options[$option_name] = \content_site\call_function::option_default($option_name);
				}
			}
		}


		$thisDefault = array_merge($default_options, $detail, $default);

		$result['preview']                 = array_merge($thisDefault, $result['preview']);
		$result['preview']['id']           = a($result, 'id');
		$result['preview']['preview_mode'] = true;
		$result['preview_layout']          = null;

		if(a($result, 'status_preview') === 'hidden' || a($result, 'status_preview') === 'deleted')
		{
			// needless to generate layout
		}
		else
		{
			if($_generate_layout)
			{
				$result['preview_layout'] = \content_site\call_function::layout($section_key, $result['preview']);
			}
		}


		// if(\dash\header::get('x-xhr-html') === "pageBuilderSection_". a($result, 'id'))
		// {
		// 	\dash\data::xhrHtml($result['preview_layout']);
		// }


		if(!\dash\engine\content::is('site') && $result['body'] && $_generate_layout)
		{
			$result['body']           = array_merge($thisDefault, $result['body']);

			$result['body_layout']    = \content_site\call_function::layout($section_key, $result['body']);

		}

		if(\dash\request::get('preview') === md5(\dash\data::currentPageDetail_datecreated()))
		{
			$result['body']        = $result['preview'];
			$result['body_layout'] = $result['preview_layout'];
		}

		return $result;
	}


	/**
	 * Array diff recersive
	 *
	 * @param      <type>  $_array_1  The array 1
	 * @param      <type>  $_array_2  The array 2
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	private static function array_recursive_diff($_array_1, $_array_2)
	{
		$result = [];

		foreach ($_array_1 as $key => $value)
		{
			if (array_key_exists($key, $_array_2))
			{
				if (is_array($value))
				{
					$my_result = self::array_recursive_diff($value, $_array_2[$key]);

					if (count($my_result))
					{
						$result[$key] = $my_result;
					}
				}
				else
				{
					if ($value != $_array_2[$key])
					{
						$result[$key] = $value;
					}
				}
			}
			else
			{
				$result[$key] = $value;
			}
		}

  		return $result;
	}

}
?>