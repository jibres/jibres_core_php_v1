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
		$list[] = self::header_1();
		$list[] = self::header_2();
		$list[] = self::header_3();

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


	private static function header_1()
	{
		$header_1 =
		[
			'key'          => 'header_1',
			'title'        => T_("Header #1"),
			'desc'         => T_("A modern and beautiful template to introduce your news \n This header contain your store title and description and have one menu at top"),
			'sample_image' => \dash\url::logo(),
			'version'      => 1,
			'tag'          =>
			[
				'news'   => T_('#news'),
				'modern' => T_('#modern'),
				'menu'   => T_('#menu'),
			],
			'contain'      =>
			[
				'header_menu_1' =>
				[
					"title" => T_("Header menu"),
					"desc" => T_("Show top of menu")
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
			'desc'         => T_("A modern and beautiful store template to introduce products and offer them \n This header contain cart link and login link and your store logo was show on header"),
			'sample_image' => \dash\url::logo(),
			'version'      => 1,
			'tag'          =>
			[
				'store'  => T_('#Shop_mode'),
				'modern' => T_('#modern'),
				'cart'   => T_('#cart_manager'),
				'search' => T_('#search_button'),
				'login'  => T_('#login_link'),
				'logo'   => T_('#logo'),
			],
			'contain'      =>
			[
				'header_logo' =>
				[
					"title" => T_("Website logo"),
					"desc" => T_("Show on header")
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
			'desc'         => T_("A modern and beautiful store template to introduce products and offer them \n This header contain cart link and login link and your store logo was show on header"),
			'sample_image' => \dash\url::logo(),
			'version'      => 1,
			'tag'          =>
			[
				'store'  => T_('#Shop_mode'),
				'modern' => T_('#modern'),
				'cart'   => T_('#cart_manager'),
				'search' => T_('#search_button'),
				'login'  => T_('#login_link'),
				'logo'   => T_('#logo'),
			],
			'contain'      =>
			[
				'header_logo' =>
				[
					"title" => T_("Website logo"),
					"desc" => T_("Show on header")
				],
			],
		];

		return $header_3;
	}


}
?>