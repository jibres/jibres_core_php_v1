<?php
namespace lib\app\website\body;

class template
{

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


	public static function get_keys()
	{
		$list = self::list();
		$keys = array_column($list, 'key');
		return $keys;
	}



	public static function list()
	{
		$list             = [];

		$list[] =
		[
			'key'          => 'slider',
			'title'        => T_("Slider"),
			'version'      => 1,
			'max_capacity' => 10, // capacity of product
		];


		$list[] =
		[
			'key'          => 'text',
			'title'        => T_("Text"),
			'version'      => 1,
		];



		$list[] =
		[
			'key'          => 'titleline',
			'title'        => T_("Title line"),
			'version'      => 1,
		];

		$list[] =
		[
			'key'          => 'quote',
			'title'        => T_("Quote"),
			'version'      => 1,
		];

		$list[] =
		[
			'key'          => 'productline',
			'title'        => T_("Products"),
			'version'      => 1,
		];

		$list[] =
		[
			'key'          => 'news',
			'title'        => T_("News"),
			'version'      => 1,
		];


		$list[] =
		[
			'key'          => 'imageblock',
			'title'        => T_("Image box"),
			'version'      => 1,
			'max_capacity' => 6, // capacity of product
		];



		$list[] =
		[
			'key'          => 'specialslider',
			'title'        => T_("Special slider"),
			'version'      => 1,
			'max_capacity' => 10, // capacity of product
		];


		return $list;
	}







}
?>