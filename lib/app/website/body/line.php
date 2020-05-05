<?php
namespace lib\app\website\body;

class line
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



	public static function list()
	{
		$list             = [];

		$list[] =
		[
			'key'   => 'body_last_news',
			'title' => T_("Lates News"),
		];

		$list[] =
		[
			'key'   => 'body_last_product',
			'title' => T_("Lates Product"),
		];

		$list[] =
		[
			'key'   => 'body_3_column_pic',
			'title' => T_("Picture in 3 column"),
		];

		$list[] =
		[
			'key'   => 'body_list_category',
			'title' => T_("List of your category"),
		];



		return $list;
	}



}
?>