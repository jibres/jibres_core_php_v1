<?php
namespace content_site\template;


class preview
{
	public static function list($_args = [])
	{
		$list = [];

		$list[] = site\demo_001::detail();
		$list[] = site\demo_002::detail();





		$result             = [];
		$result['preview']  = $list;
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