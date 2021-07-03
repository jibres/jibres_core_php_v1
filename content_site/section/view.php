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
			\content_site\controller::load_current_section_list();

			self::generate_back_url();
		}
		else
		{
			// add new section

			\dash\face::title(T_('Add new Section'));

			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::here(). '/page'. \dash\request::full_get(self::$remove_needless_get));


			$section_list = controller::section_list();

			$section_list = self::show_section_preview_in_group($section_list);

			\dash\data::sectionList($section_list);

			\dash\data::include_adminPanelBuilder(true);

		}

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
	 *
	 * Just for show pretty in current html (Not used anywhere else)
	 *
	 * @param      <type>  $section_list  The section list
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	private static function show_section_preview_in_group($section_list)
	{
		$new_list = [];

		$get_list = \dash\request::get('list');

		$section = \dash\request::get('section');

		foreach ($section_list as $key => $value)
		{
			$mode = \content_site\call_function::get_folder(a($value, 'key'));

			if($get_list && $get_list !== $mode)
			{
				continue;
			}


			if(!isset($new_list[a($value, 'group')]))
			{
				$new_list[a($value, 'group')] = [];
			}

			if($section && a($value, 'key') === $section)
			{
				$load_preview_list = \content_site\call_function::preview_list($value['key']);

				$value['preview_list'] = $load_preview_list;
			}

			$new_list[a($value, 'group')][] = $value;
		}

		return $new_list;
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
	public static function ready_section_list($_data)
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

		if(!a($result, 'preview') && a($result, 'body'))
		{
			$result['preview'] = $result['body'];
		}

		if(!a($result, 'preview_layout') && a($result, 'body_layout'))
		{
			$result['preview_layout'] = $result['body_layout'];
		}

		$default = [];

		$detail  = [];

		$detail = \content_site\call_function::detail($section_key);

		if(!is_array($detail))
		{
			$detail = [];
		}

		$default = \content_site\call_function::default($section_key);

		if(!is_array($default))
		{
			$default = [];
		}

		$result['preview']        = array_merge($detail, $default, $result['preview']);

		$result['preview_layout'] = \content_site\call_function::layout($section_key, $result['preview']);

		$result['body']           = array_merge($detail, $default, $result['body']);

		$result['body_layout']    = \content_site\call_function::layout($section_key, $result['body']);

		return $result;
	}

}
?>