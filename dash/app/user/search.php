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
		$condition =
		[
			'order'     => 'order',
			'sort'      => 'string_50',
			'status'    => ['enum' => ['sale', 'buy', 'saleorder']],
			'show_type' => ['enum' => ['staff', 'all']],
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$or            = [];
		$order_sort    = null;
		$meta['limit'] = 15;

		if($data['show_type'] === 'staff')
		{
			$and[] = " users.permission IS NOT NULL ";
		}
		else
		{
			/*nothing*/
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
