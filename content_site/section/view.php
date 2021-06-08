<?php
namespace content_site\section;


class view
{
	public static function config()
	{
		if(\dash\url::child())
		{

			\content_site\controller::load_current_section_list();


			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::here(). '/page'. \dash\request::full_get(['sid' => null]));
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

						$namespace = '\\content_site\\ganje\\'. $value['key']. '\\option';

						if(is_callable([$namespace, 'detail']))
						{
							$detail = call_user_func([$namespace, 'detail']);
							if(!is_array($detail))
							{
								$detail = [];
							}
						}

						if(is_callable([$namespace, 'default']))
						{
							$default = call_user_func([$namespace, 'default']);
							if(!is_array($default))
							{
								$default = [];
							}
						}

						$value = array_merge($detail, $default, $value);


						$result['layout'] = call_user_func(['\\content_site\\ganje\\'. $value['key']. '\\layout', 'layout'], $value);
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




	/**
	 * Load current section detail
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function current_section_detail()
	{
		$page_id    = \dash\coding::decode(\dash\request::get('id'));
		$section_id = \dash\validate::id(\dash\request::get('sid'));

		if(!$page_id || !$section_id)
		{
			return false;
		}

		$section_detail = \lib\db\pagebuilder\get::by_id_related_id($section_id, $page_id);

		if(!is_array($section_detail) || !$section_detail)
		{
			return false;
		}

		$section_detail = self::ready_section_list($section_detail);

		if(isset($section_detail['preview']['key']) && $section_detail['preview']['key'] === \dash\url::child())
		{
			// ok
		}
		else
		{
			return false;
		}

		\dash\data::currentSectionDetail($section_detail);

		return $section_detail;

	}
}
?>