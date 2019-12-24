<?php
namespace lib\app\factor;

class search
{
	private static $filter_message = null;
	private static $filter_args    = [];
	private static $is_filtered    = false;


	public static function filter_message()
	{
		return self::$filter_message;
	}


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	private static function factors_list($_type, $_query_string, $_args, $_where = [])
	{
		$default_args =
		[
			'order'        => null,
			'sort'         => null,

		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		if(!is_array($_where))
		{
			$_where = [];
		}

		$_args       = array_merge($default_args, $_args);
		$type        = $_type;
		$and         = [];
		$meta        = [];
		$or          = [];

		$order_sort  = null;


		// if($_args['barcode'])
		// {
		// 	$barcode                 = \dash\number::clean($_args['barcode']);
		// 	$and['factors.barcode'] = $barcode;
		// 	self::$filter_args['barcode']  = '*'. T_('Barcode');
		// 	self::$is_filtered       = true;
		// }


		$query_string = \dash\safe::forQueryString($_query_string);

		$query_string = mb_substr($query_string, 0, 50);

		if($query_string)
		{
			$or['factors.title']        = ["LIKE", "'%$query_string%'"];
			// $or['factors.slug']     = ["LIKE", "'$query_string%'"];

			$query_string_barcode = \dash\utility\convert::to_barcode($query_string);

			if($query_string_barcode)
			{
				$or['factors.id']  = ["=", "'$query_string'"];
			}

			$or['factors.sku']      = ["=", "'$query_string'"];
			self::$is_filtered = true;
		}


		if($_args['sort'] && !$order_sort)
		{

			$check_order_trust = \lib\app\factor\filter::check_allow($_args['sort'], $_args['order'], $type);

			if($check_order_trust)
			{
				$sort = mb_strtolower($_args['sort']);
				$order = null;
				if($_args['order'])
				{
					$order = mb_strtolower($_args['order']);
				}

				$order_sort = " ORDER BY $sort $order";
			}
		}


		$and = array_merge($and, $_where);

		switch ($type)
		{
			default:
				$list = \lib\db\factors\search::list($and, $or, $order_sort, $meta);
				break;
		}

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\factor\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		$filter_args_data = [];

		foreach (self::$filter_args as $key => $value)
		{
			if(isset($list[0][$key]) && substr($value, 0, 1) === '*')
			{
				$filter_args_data[substr($value, 1)] = $list[0][$key];
			}
			else
			{
				$filter_args_data[$key] = $value;
			}
		}

		self::$filter_message = \dash\app\sort::createFilterMsg($query_string, $filter_args_data);

		return $list;
	}



	public static function list($_string, $_args)
	{
		$list = self::factors_list('detail', $_string, $_args);
		return $list;
	}

}
?>
