<?php
namespace lib\app\website_footer;

class template
{


	public static function get_keys()
	{
		$list_keys = self::list();
		$list_keys = array_column($list_keys, 'key');
		return $list_keys;
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
		$list[] = self::footer_1();
		$list[] = self::footer_2();

		return $list;
	}


	private static function footer_1()
	{
		$footer_1 =
		[
			'key'          => 'footer_1',
			'title'        => T_("Footer #1"),
			'desc'         => T_("Description"),
			'sample_image' => \dash\url::logo(),
			'css_file'     => 'the css file location addr',
			'contain'      => ['footer_menu_1',],
		];

		return $footer_1;
	}



	private static function footer_2()
	{
		$footer_2 =
		[
			'key'          => 'footer_2',
			'title'        => T_("Footer #2"),
			'desc'         => T_("Description"),
			'sample_image' => \dash\url::logo(),
			'css_file'     => 'the css file location addr',
			'contain'      => ['footer_menu_1', 'footer_menu_2', ],
		];

		return $footer_2;
	}


}
?>