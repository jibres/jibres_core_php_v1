<?php
namespace lib\app\premium;


class get
{
	public static function all_list()
	{
		$dir_list = glob(__DIR__. '/items/*', GLOB_ONLYDIR);

		$premium  = [];

		foreach ($dir_list as $dir)
		{
			$file_list = glob($dir. '/*.php');

			foreach ($file_list as $file)
			{
				$premium_key = str_replace('.php', '', basename($file));
				$temp        = \lib\app\premium\call_function::detail($premium_key);

				if($temp)
				{
					$temp['premium_key'] = $premium_key;
					$premium[] =  $temp;
				}
			}
		}

		return $premium;

	}


	/**
	 * Get premium detail
	 *
	 * @param      <type>  $_premium  The premium
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function detail($_premium)
	{
		return \lib\app\premium\call_function::detail($_premium);
	}


	public static function all_list_by_count()
	{
		$list         = self::all_list();
		$count_all    = \lib\db\store_premium\get::group_by_premium_key();
		$count_enable = \lib\db\store_premium\get::group_by_premium_key_status('enable');

		foreach ($list as $key => $value)
		{
			if(isset($value['premium_key']))
			{
				if(isset($count_all[$value['premium_key']]))
				{
					$list[$key]['count_use'] = $count_all[$value['premium_key']];
				}

				if(isset($count_enable[$value['premium_key']]))
				{
					$list[$key]['count_enable'] = $count_enable[$value['premium_key']];
				}
			}
		}

		return $list;

	}


	public static function price($_premium)
	{
		$price = \lib\app\premium\call_function::price($_premium);

		if(!$price)
		{
			$price = 0;
		}

		return $price;
	}


	public static function zone($_premium)
	{
		$zone = \lib\app\premium\call_function::zone($_premium);

		if(!$zone)
		{
			$zone = 0;
		}

		return $zone;
	}


	public static function title($_premium)
	{
		$title = \lib\app\premium\call_function::title($_premium);

		return $title;
	}



}
?>