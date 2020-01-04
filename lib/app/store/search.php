<?php
namespace lib\app\store;

class search
{
	private static $filter_message = null;

	public static function filter_message()
	{
		return self::$filter_message;
	}

	public static function list($_query_string, $_args)
	{
		return self::store_list('list', $_query_string, $_args);
	}

	public static function list_analytics($_query_string, $_args)
	{
		return self::store_list('analytics', $_query_string, $_args);
	}




	private static function store_list($_type, $_query_string, $_args, $_where = [])
	{
		$default_args =
		[
			'order'        => null,
			'sort'         => null,

			// 'guarantee_id' => null,

			'filter'       => [],
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		if(!is_array($_where))
		{
			$_where = [];
		}

		$_args = array_merge($default_args, $_args);

		$and         = [];
		$or          = [];
		$filter_args = [];
		$order_sort  = null;


		$query_string     = \dash\safe::forQueryString($_query_string);

		if($query_string)
		{
			$or['store_data.title'] = ["LIKE", "'%$query_string%'"];
			$or['store.subdomain'] = ["LIKE", "'%$query_string%'"];
		}

		$and = array_merge($and, $_where);

		switch ($_type)
		{
			case 'analytics':
				$list = \lib\db\store\search::analytics($and, $or, $order_sort);
				break;

			case 'list':
			default:
				$list = \lib\db\store\search::list($and, $or, $order_sort);
				break;
		}

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\store\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		$filter_args_data = [];

		foreach ($filter_args as $key => $value)
		{
			if(isset($list[0][$key]))
			{
				$filter_args_data[$value] = $list[0][$key];
			}
		}

		self::$filter_message = \dash\app\sort::createFilterMsg($query_string, $filter_args_data);

		return $list;
	}
}
?>