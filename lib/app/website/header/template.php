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
		$list['header_100'] = self::header_100();
		$list['header_300'] = self::header_300();


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


	private static function header_100()
	{
		$myHeader =
		[
			'key'          => 'header_100',
			'title'        => T_("Header #1"),
			'desc'         => T_("A modern and beautiful header"),
			'sample_image' => \dash\url::cdn(). '/img/template/header/header100.jpg',
			'version'      => 3,
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
				],

				'header_menu_1' =>
				[
					"title" => T_("Header Primary Menu"),
				],

				'header_menu_2' =>
				[
					"title" => T_("Header Secondary Menu"),
					"desc"  => T_("This menu is shown on left side of header menu bar.")
				],
			],
		];

		return $myHeader;
	}


	private static function header_300()
	{
		$myHeader =
		[
			'key'          => 'header_300',
			'title'        => T_("Header #2"),
			'desc'         => T_("A modern and beautiful template to introduce your news \n This header contain your store title and description and have one menu at top"),
			'sample_image' => \dash\url::cdn(). '/img/template/header/header300.jpg',
			'version'      => 2,
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
					"title" => T_("Header Primary Menu"),
				],
			],

		];

		return $myHeader;
	}


}
?>