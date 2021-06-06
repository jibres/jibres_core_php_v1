<?php
namespace content_site\section;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new Section'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here(). '/page'. \dash\request::full_get());


		$section_list = controller::section_list();
		$section_list = self::show_in_group($section_list);
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


	private static function show_in_group($section_list)
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


	public static function default_view_config()
	{
		\content_site\controller::load_current_section_list();

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here(). '/page'. \dash\request::full_get(['sid' => null]));

	}
}
?>