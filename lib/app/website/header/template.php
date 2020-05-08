<?php
namespace lib\app\website\header;

class template
{


	public static function get_keys()
	{
		$list_keys = self::list();
		$list_keys = array_column($list_keys, 'key');
		return $list_keys;
	}


	public static function get_contain($_key)
	{
		$result = self::get($_key, 'contain');
		if($result && is_array($result))
		{
			return array_keys($result);
		}
		return [];
	}

	/**
	 * Get one template detail
	 *
	 * @param      <type>  $_key   The key
	 * @param      <type>  $_need  The need
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get($_key, $_need = null)
	{
		$list = self::list();

		$list = array_combine(array_column($list, 'key'), $list);

		if(isset($list[$_key]))
		{
			if($_need)
			{
				if(array_key_exists($_need, $list[$_key]))
				{
					return $list[$_key][$_need];
				}
				else
				{
					return null;
				}
			}
			else
			{
				return $list[$_key];
			}
		}
		return null;
	}



	public static function list()
	{
		$list             = [];
		$list[] = self::header_1();
		$list[] = self::header_2();
		$list[] = self::header_3();

		return $list;
	}


	private static function header_1()
	{
		$header_1 =
		[
			'key'          => 'header_1',
			'title'        => T_("Header #1"),
			'desc'         => T_("Description"),
			'sample_image' => \dash\url::logo(),
			'version'      => 1,
			'tag'          => ['tag1'],
			'contain'      =>
			[
				'header_logo' =>
				[
					"desc" => T_("Show on header")
				],
				'header_menu_1' =>
				[
					"title" => T_("Menu 1"),
					"desc" => T_("Menu on your header"),
				],
			],
		];

		return $header_1;
	}



	private static function header_2()
	{
		$header_2 =
		[
			'key'          => 'header_2',
			'title'        => T_("Header #2"),
			'desc'         => T_("Description"),
			'sample_image' => \dash\url::logo(),
			'version'      => 1,
			'tag'          => ['tag1'],
			'contain'      =>
			[
				'header_logo' =>
				[
					"desc" => T_("Show on header")
				],
				'header_menu_1' =>
				[
					"title" => T_("Menu 1"),
					"desc" => T_("Menu on your header"),
				],
				'header_menu_2' =>
				[
					"title" => T_("Menu 2"),
					"desc" => T_("Menu on your header"),
				],
			],
		];

		return $header_2;
	}


	private static function header_3()
	{
		$header_3 =
		[
			'key'          => 'header_3',
			'title'        => T_("Header #3"),
			'desc'         => T_("Description"),
			'sample_image' => \dash\url::logo(),
			'version'      => 1,
			'tag'          => ['tag1'],
			'contain'      =>
			[
				'header_logo' =>
				[
					"desc" => T_("Show on header")
				],
				'header_menu_1' =>
				[
					"title" => T_("Menu 1"),
					"desc" => T_("Menu on your header"),
				],
			],
		];

		return $header_3;
	}


}
?>