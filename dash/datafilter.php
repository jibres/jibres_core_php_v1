<?php
namespace dash;

trait datafilter
{

	// get public sort list for api and application
	public static function public_sort_list($_module = null)
	{
		$_module          = \dash\validate::string($_module);
		$list             = self::sort_list($_module);
		$public_sort_list = [];
		foreach ($list as $key => $value)
		{
			if(isset($value['public']) && $value['public'])
			{
				$public_sort_list[] = $value;
			}
		}

		return $public_sort_list;
	}


	public static function check_allow($_sort, $_order, $_module = null)
	{
		$order = \dash\str::mb_strtolower($_order);
		if($order && in_array($order, ['asc', 'desc']))
		{
			$sort = \dash\str::mb_strtolower($_sort);
			if($sort)
			{
				$list     = self::sort_list($_module);
				$query    = array_column($list, 'query');
				$sort_key = array_column($query, 'sort');

				if(in_array($sort, $sort_key))
				{
					return true;
				}
			}
		}

		return false;
	}


	public static function sort_enum($_module = null)
	{
		$list     = self::sort_list($_module);
		$query    = array_column($list, 'query');
		$sort_key = array_column($query, 'sort');
		$sort_key = array_filter($sort_key);
		$sort_key = array_unique($sort_key);

		return ['enum' => $sort_key];
	}


	public static function sort_list()
	{
		// public => true means show in api and site

		$sort_list = [];

		if(\dash\request::get('sort'))
		{
			$sort_list[] =
				[
					'title'  => T_("Clear Sort"),
					'query'  =>
						[
							'sort'  => null,
							'order' => null,
						],
					'public' => true,
				];
		}
		else
		{
			$sort_list[] =
				[
					'title'  => T_("Sort"),
					'query'  =>
						[
							'sort'  => null,
							'order' => null,
						],
					'clear'  => true,
					'public' => true,
				];
		}

		$sort_list = array_merge($sort_list, self::sort_list_array(...func_get_args()));

		$current_string_query = \dash\request::get();
		unset($current_string_query['sort']);
		unset($current_string_query['order']);

		foreach ($sort_list as $key => $value)
		{
			$myQuery                         = [];
			$myQuery                         = array_merge($value['query'], $current_string_query);
			$sort_list[$key]['query_string'] = http_build_query($myQuery);
		}

		return $sort_list;
	}


	public static function list()
	{
		$list = self::list_of_filter(...func_get_args());

		$get = \dash\request::get();

		foreach ($list as $key => $value)
		{
			if(isset($value['query']))
			{
				$active = false;
				foreach ($value['query'] as $k => $v)
				{
					if(isset($get[$k]) && $get[$k] == $v)
					{
						$active = true;
						break;
					}
				}

				if($active)
				{
					$myQuery      = array_map(function ($_a)
					{
						return null;
					}, $value['query']);
					$query_string = \dash\request::fix_get($myQuery);
				}
				else
				{
					$query_string = \dash\request::fix_get($value['query']);
				}

				$list[$key]['query_string'] = $query_string;
				$list[$key]['is_active']    = $active;
			}
		}

		return $list;
	}


}

?>