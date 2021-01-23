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
			'sort'      => 'string_50',
			'status'    => ['enum' => ['approved','awaiting','unapproved','spam','deleted','filter','close', 'answered']],
			'so'        => 'y_n',
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

		if($data['status'])
		{
			$and[] = " tickets.status = '$data[status]' ";
			self::$is_filtered = true;
		}
		else
		{
			$and[] = " tickets.status NOT IN ('deleted', 'spam') ";

		}

		if($data['so'] === 'y')
		{
			$and[] = " tickets.solved = 1 ";
			self::$is_filtered = true;
		}
		elseif($data['so'] === 'n')
		{
			$and[] = " ( tickets.solved IS NULL OR tickets.solved =  0 ) ";
			self::$is_filtered = true;
		}

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
			if(\dash\app\ticket\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort = " ORDER BY $data[sort] $data[order]";
			}
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
