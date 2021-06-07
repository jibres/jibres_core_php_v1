<?php
namespace lib\sitebuilder;


class section_list
{
	public static function get()
	{
		$section_list_key =
		[
			'blog',
		];

		$section_list = [];

		foreach ($section_list_key as $key => $section)
		{
			$namespace = '\\lib\\sitebuilder\\section\\'. $section;

			$allow = call_user_func([$namespace, 'allow']);

			if(!$allow)
			{
				continue;
			}

			$section_list[] = call_user_func([$namespace, 'detail']);
		}

		return $section_list;

	}
}
?>