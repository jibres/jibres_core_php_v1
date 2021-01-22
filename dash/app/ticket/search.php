<?php
namespace dash\app\ticket;

class search
{

	private static $is_filtered    = false;


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function last_5_ticket()
	{
		return self::list(null, ['limit' => 5]);
	}


	public static function list($_query_string, $_args)
	{

		\dash\permission::access('crmShowTicketsList');

		$condition =
		[
			'order'     => 'order',
			'sort'      => ['enum' => ['date', 'subprice', 'subtotal', 'subdiscount', 'item', 'qty','customer']],
			'status'    => ['enum' => ['sale', 'buy', 'saleorder']],
			'show_type' => ['enum' => ['verify', 'all']],
			'user_code' => 'code',
			'limit'     => 'int',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$or            = [];
		$order_sort    = null;
		$meta['limit'] = 15;

		if($data['limit'])
		{
			$meta['limit'] = $data['limit'];
		}

		$and[] = " tickets.parent IS NULL ";


		if($data['user_code'])
		{
			$user_id = \dash\coding::decode($data['user_code']);
			$and[] = " tickets.user_id =  $user_id ";

		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " tickets.title LIKE '%$query_string%' ";
			$or[] = " tickets.content LIKE '%$query_string%' ";
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
			$order_sort = " ORDER BY tickets.id DESC ";
		}

		$list = \dash\db\tickets\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\ticket\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}

}
?>
