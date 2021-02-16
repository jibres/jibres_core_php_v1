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
		return self::list(null, ['limit' => 5], true);
	}


	public static function last_ticket_user($_user_id)
	{
		$args =
		[
			'user'       => \dash\coding::encode($_user_id),
			'sort'       => 'datemodified',
			'order'      => 'desc',
			'limit'      => 5,
			'pagination' => 'n',
		];

		return self::list(null, $args, true);
	}

	public static function list($_query_string, $_args, $_force = false)
	{
		if(!$_force)
		{
			\dash\permission::access('crmShowTicketsList');
		}

		$condition =
		[
			'order'         => 'order',
			'sort'          => 'string_50',
			'status'        => ['enum' => ['approved','awaiting','unapproved','spam','deleted','filter','close', 'answered']],
			'so'            => 'y_n',
			'hf'            => 'y_n',
			'hu'            => 'y_n',
			'user'          => 'code',
			'limit'         => 'int',
			'pagination'    => 'y_n',
			'customer_mode' => 'bit',
			'message_mode'  => 'bit',
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

		if($data['pagination'] === 'n')
		{
			$meta['pagination'] = false;
		}

		if($data['message_mode'])
		{
			// nothing
		}
		else
		{
			$and[] = " tickets.parent IS NULL ";
		}

		if($data['status'])
		{
			$and[] = " tickets.status = '$data[status]' ";
			self::$is_filtered = true;
		}
		else
		{
			$and[] = " tickets.status NOT IN ('deleted', 'spam') ";
		}

		if($data['customer_mode'])
		{
			if(\dash\user::id())
			{
				$user_id = \dash\user::id();
				$and[] = " tickets.user_id = $user_id ";
			}
			else
			{
				$guestid = \dash\user::get_user_guest();
				if($guestid)
				{
					$and[] = " tickets.guestid = '$guestid' ";
				}
				else
				{
					return [];
				}
			}
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

		if($data['hf'] === 'y')
		{
			$and[] = " tickets.file IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['hf'] === 'n')
		{
			$and[] = " tickets.file IS NULL ";
			self::$is_filtered = true;
		}


		if($data['hu'] === 'y')
		{
			$and[] = " tickets.user_id IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['hu'] === 'n')
		{
			$and[] = " tickets.user_id IS NULL ";
			self::$is_filtered = true;
		}

		if($data['user'])
		{
			$user_id = \dash\coding::decode($data['user']);
			$and[] = " tickets.user_id =  $user_id ";

		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			if($isInt = \dash\validate::int($query_string, false))
			{
				$or[] = " tickets.id = '$isInt' ";
			}

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
