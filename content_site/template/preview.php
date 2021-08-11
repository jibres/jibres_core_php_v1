<?php
namespace content_site\template;


class preview
{
	public static function list()
	{
		$category = \dash\request::get('category');

		$list   = [];
		$list[] = site\demo_001::detail();
		$list[] = site\demo_002::detail();

		$new_list = [];
		foreach ($list as $key => $value)
		{
			if($category && $category !== 'all')
			{
				if(a($value, 'category') !== $category)
				{
					continue;
				}
			}

			$new_list[] = $value;
		}


		$result             = [];
		$result['preview']  = $new_list;
		$result['category'] = self::category();
		return $result;
	}


	private static function category()
	{
		return
		[
			'category1' => ['title' => T_("Category 1")],
			'category2' => ['title' => T_("Category 2")],
		];
	}
}
?>