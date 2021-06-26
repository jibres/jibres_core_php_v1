<?php
namespace content_site\section;


class view
{
	public static function config()
	{
		if(\dash\url::child())
		{

			\content_site\controller::load_current_section_list();

			self::generate_back_url();
		}
		else
		{
			\dash\face::title(T_('Add new Section'));

			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::here(). '/page'. \dash\request::full_get());


			$section_list = controller::section_list();
			$section_list = self::show_section_in_group($section_list);
			\dash\data::sectionList($section_list);

			$saved_section = \content_site\controller::load_current_section_list('with_adding');

			if(is_array($saved_section))
			{
				$end_section = end($saved_section);
				if(isset($end_section['preview']['adding']))
				{
					\dash\data::addingDetail($end_section);
					\dash\data::adding(true);
				}
			}
		}

	}

	public static function generate_back_url()
	{
		\dash\data::back_text(T_('Back'));

		$dir = \dash\url::dir();
		array_pop($dir);

		if(count($dir) >= 2)
		{
			$url = \dash\url::here(). '/';
			$url .= implode('/', $dir);
			$url .= \dash\request::full_get(['index' => null]);
		}
		else
		{
			$url = \dash\url::here();
			$url .= '/page';
			$url .= \dash\request::full_get(['index' => null, 'sid' => null]);
		}

		\dash\data::back_link($url);
		return $url;
	}

	/**
	 * Shows the section in group.
	 *
	 * @param      <type>  $section_list  The section list
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	private static function show_section_in_group($section_list)
	{
		$new_list = [];
		foreach ($section_list as $key => $value)
		{
			if(!isset($new_list[a($value, 'group')]))
			{
				$new_list[a($value, 'group')] = [];
			}

			$new_list[a($value, 'group')][] = $value;
		}

		return $new_list;
	}


	/**
	 * Gets the current index detail from preview
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


					if(isset($value['key']) && is_string($value['key']))
					{
						$default = [];

						$detail  = [];


						$detail = \content_site\call_function::detail($value['key']);

						if(!is_array($detail))
						{
							$detail = [];
						}

						$default = \content_site\call_function::default($value['key']);

						if(!is_array($default))
						{
							$default = [];
						}


						$value = array_merge($detail, $default, $value);


						$result['layout'] = \content_site\call_function::layout($value['key'], $value);

					}



					$result[$key] = $value;
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

		return $result;

	}

}
?>