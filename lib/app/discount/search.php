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

		\dash\permission::access('manageDiscountCode');

		$condition =
		[
			'order'  => 'order',
			'sort'   => 'string_100',
			'status' => ['enum' => ['enable', 'draft', 'deleted']],
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$param = [];
		$and   = [];
		$meta  = [];
		$or    = [];

		$meta['limit'] = 20;
		// $meta['pagination'] = false;

		$order_sort  = null;

		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " discount.code LIKE :search_string ";
			$param[':search_string'] = '%'. $query_string. '%';
			self::$is_filtered = true;
		}


		if($data['status'])
		{
			$and[] = " discount.status = :status ";
			$param[':status'] = $data['status'];
			self::$is_filtered = true;
		}
		else
		{
			$and[] = " discount.status != :status ";
			$param[':status'] = 'deleted';
		}



		if($data['sort'] && !$order_sort)
		{
			if(\lib\app\discount\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort      = " ORDER BY $data[sort] $data[order] ";

			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY discount.id ASC";
		}

		$list = \lib\db\discount\search::list($param, $and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\discount\\ready', 'row'], $list);

		return $list;
	}

}
?>