<?php
namespace content_site\section;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new line'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/site'. \dash\request::full_get());


		$section_list = controller::section_list();
		$section_list = self::show_in_group($section_list);
		\dash\data::sectionList($section_list);

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
}
?>