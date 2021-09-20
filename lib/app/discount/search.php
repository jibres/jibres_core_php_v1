<?php
namespace lib\app\discount;


class search
{

	private static $filter_args    = [];
	private static $is_filtered    = false;


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args)
	{

		$condition =
		[
			'order'  => 'order',
			'sort'   => 'string_100',
			'status' => ['enum' => ['enable', 'draft']],
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;
		// $meta['pagination'] = false;

		$order_sort  = null;

		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " discount.code LIKE '$query_string%' ";
			self::$is_filtered = true;
		}


		if($data['status'])
		{
			$and[] = " discount.status = '$data[status]' ";
			self::$is_filtered = true;
		}



		if($data['sort'] && !$order_sort)
		{
			if(\lib\app\discount\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort = " ORDER BY $data[sort] $data[order]";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY discount.id ASC";
		}

		$list = \lib\db\discount\search::list($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\discount\\ready', 'row'], $list);

		return $list;
	}

}
?>