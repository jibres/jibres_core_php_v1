<?php
namespace dash\app\user;

class search
{

	private static $is_filtered    = false;


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args)
	{
		\dash\permission::access('_group_crm');

		$condition =
		[
			'order'     => 'order',
			'sort'      => 'string_50',
			'status'    => ['enum' => ['active','awaiting','deactive','removed','filter','unreachable', 'ban', 'block']],
			'show_type' => ['enum' => ['staff', 'all']],
			'permission'      => 'string_50',

			'hm'        => 'y_n',
			'ho'        => 'y_n',
			'hc'        => 'y_n',
			'hp'        => 'y_n',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$or            = [];
		$order_sort    = null;
		$meta['limit'] = 15;
		$meta['join'] = [];
		$meta['fields'] = 'users.*';

		if($data['show_type'] === 'staff')
		{
			$and[] = " users.permission IS NOT NULL ";
		}
		else
		{
			/*nothing*/
		}


		if($data['permission'])
		{
			$and[] = " users.permission = '$data[permission]' ";
		}

		if($data['hm'] === 'y')
		{
			$and[] = " users.mobile IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['hm'] === 'n')
		{
			$and[] = " users.mobile IS NULL ";
			self::$is_filtered = true;

		}

		if($data['hp'] === 'y')
		{
			$and[] = " users.permission IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['hp'] === 'n')
		{
			$and[] = " users.permission IS NULL ";
			self::$is_filtered = true;

		}

		if(\dash\engine\store::inStore())
		{
			if($data['ho'] === 'y')
			{
				$meta['fields'] = ' DISTINCT users.* ';
				$meta['join'][] = " INNER JOIN factors ON factors.customer = users.id ";
				self::$is_filtered = true;
			}
			elseif($data['ho'] === 'n')
			{
				$meta['fields'] = ' DISTINCT users.* ';
				$meta['join'][] = " LEFT JOIN factors ON factors.customer = users.id ";
				$and[] = " factors.id IS NULL ";
				self::$is_filtered = true;

			}

			if($data['hc'] === 'y')
			{
				$meta['fields'] = ' DISTINCT users.* ';
				$meta['join'][] = " INNER JOIN cart ON cart.user_id = users.id ";
				self::$is_filtered = true;
			}
			elseif($data['hc'] === 'n')
			{
				$meta['fields'] = ' DISTINCT users.* ';
				$meta['join'][] = " LEFT JOIN cart ON cart.user_id = users.id ";
				$and[] = " cart.id IS NULL ";
				self::$is_filtered = true;

			}
		}

		if($data['status'])
		{
			$and[] = " users.status = '$data[status]' ";
			self::$is_filtered = true;
		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " users.mobile LIKE '%$query_string%' ";
			$or[] = " users.displayname LIKE '%$query_string%' ";

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(\dash\app\user\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort = " ORDER BY $data[sort] $data[order]";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY users.id DESC ";
		}

		$list = \dash\db\users\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\user', 'ready'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}

}
?>
