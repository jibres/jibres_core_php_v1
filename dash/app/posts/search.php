<?php
namespace dash\app\posts;

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
			'order'     => 'order',
			'sort'      => ['enum' => ['date', 'subprice', 'subtotal', 'subdiscount', 'item', 'qty','customer']],
			'status'    => ['enum' => ['sale', 'buy', 'saleorder']],
			'user_code' => 'code',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$or            = [];
		$order_sort    = null;
		$meta['limit'] = 15;


		if($data['user_code'])
		{
			$user_id = \dash\coding::decode($data['user_code']);
			$and[] = " posts.user_id =  $user_id ";

		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " posts.title LIKE '%$query_string%' ";
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
			$order_sort = " ORDER BY posts.id DESC ";
		}

		$list = \dash\db\posts\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\posts\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}



	public static function lates_post($_args = [])
	{
		if(!isset($_args['limit']))
		{
			$_args['limit'] = 5;
			$_args['end_limit'] = 5;
		}

		$_args['order_raw'] = 'posts.id DESC';
		$_args['pagenation'] = false;
		$_args['status'] = 'publish';

		$list = \dash\db\posts::search(null, $_args);

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\posts\\ready', 'row'], $list);
		}

		return $list;
	}

}
?>
