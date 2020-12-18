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
		$list['footer_100'] = \lib\app\website\footer\template\footer_100::get();
		$list['footer_201'] = \lib\app\website\footer\template\footer_201::get();
		$list['footer_300'] = \lib\app\website\footer\template\footer_300::get();

		if(\lib\store::enterprise() === 'rafiei')
		{
			$list['footer_private_rafiei'] = \lib\app\website\footer\template\footer_private_rafiei::get();
		}


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
}
?>