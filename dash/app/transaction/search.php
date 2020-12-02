<?php
namespace dash\app\transaction;

class search
{

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
			'sort'   => ['enum' => ['date', 'subprice', 'subtotal', 'subdiscount', 'item', 'qty','customer']],
			'status' => ['enum' => ['sale', 'buy', 'saleorder']],
			'show_type' => ['enum' => ['verify', 'all']],
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$or            = [];
		$order_sort    = null;
		$meta['limit'] = 15;

		if($data['show_type'] === 'verify')
		{
			$and[] = " transactions.verify =  1 ";
		}
		else
		{
			/*nothing*/
		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " transactions.title LIKE '%$query_string%' ";
			$or[] = " transactions.plus LIKE '%$query_string%' ";
			$or[] = " transactions.minus LIKE '%$query_string%' ";
			$or[] = " users.mobile LIKE '%$query_string%' ";
			$or[] = " users.displayname LIKE '%$query_string%' ";

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			$order_sort = " ORDER BY $data[sort] $data[order]";
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY transactions.id DESC ";
		}

		$list = \dash\db\transactions\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\transaction', 'ready'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}

}
?>
