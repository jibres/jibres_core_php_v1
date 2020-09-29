<?php
namespace lib\app\website\footer;

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



	public static function list($_args = [])
	{
		$condition =
		[
			'tag'      => 'string_50',
		];

		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$list             = [];
		$list['footer_100'] = self::footer_100();
		$list['footer_201'] = self::footer_201();
		$list['footer_300'] = self::footer_300();


		if($data['tag'])
		{
			$new_list = [];
			foreach ($list as $key => $value)
			{
				if(isset($value['tag']) && is_array($value['tag']))
				{
					if(in_array($data['tag'], array_keys($value['tag'])))
					{
						$new_list[] = $value;
					}
				}
			}

			$list = $new_list;
		}

		return $list;
	}


	private static function footer_100()
	{
		$myFooter =
		[
			'key'          => 'footer_100',
			'title'        => T_("Footer #1"),
			'desc'         => T_("A modern and beautiful footer"),
			'sample_image' => \dash\url::cdn(). '/img/template/footer/footer100.png',
			'version'      => 3,
			'tag'          =>
			[
				'modern' => T_('#modern'),
			],
			'contain'      =>
			[

				'footer_main_txt' =>
				[
					"title" => T_("Footer Text"),
				],

				'footer_phone' =>
				[
					"title" => T_("Footer Phone number"),
				],
			],
		];

		return $myFooter;
	}


	private static function footer_201()
	{
		$myFooter =
		[
			'key'          => 'footer_201',
			'title'        => T_("Footer #201"),
			'desc'         => T_("A complete footer"),
			'sample_image' => \dash\url::cdn(). '/img/template/footer/footer201.jpg',
			'version'      => 1,
			'tag'          =>
			[
				'modern' => T_('#modern'),
				'complete' => T_('#complete'),
			],
			'contain'      =>
			[

				'footer_main_txt' =>
				[
					"title" => T_("Footer Text"),
				],

				'footer_phone' =>
				[
					"title" => T_("Footer Phone number"),
				],

				'footer_menu_1' =>
				[
					"title" => T_("Footer menu #1"),
					"desc" => T_("Part 1 of footer menu"),
				],

				'footer_menu_2' =>
				[
					"title" => T_("Footer menu #2"),
					"desc" => T_("Part 2 of footer menu"),
				],

				'footer_menu_3' =>
				[
					"title" => T_("Footer menu #3"),
					"desc" => T_("Part 3 of footer menu"),
				],

				'footer_menu_4' =>
				[
					"title" => T_("Footer menu #4"),
					"desc" => T_("Part 4 of footer menu"),
				],
			],
		];

		return $myFooter;
	}



	private static function footer_300()
	{
		$myFooter =
		[
			'key'          => 'footer_300',
			'title'        => T_("Footer #2"),
			'desc'         => T_("A modern and beautiful template to introduce your news \n This footer contain your store title and description and have one menu at top"),
			'sample_image' => \dash\url::cdn(). '/img/template/footer/footer300.png',
			'version'      => 2,
			'tag'          =>
			[
				'news'   => T_('#news'),
				'modern' => T_('#modern'),
				'menu'   => T_('#menu'),
			],
			'contain'      =>
			[

				'footer_main_txt' =>
				[
					"title" => T_("Footer Text"),
				],
			],

		];

		return $myFooter;
	}


}
?>