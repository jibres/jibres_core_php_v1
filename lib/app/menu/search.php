<?php
namespace lib\app\menu;


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
			'order'   => 'order',
			'sort'    => ['enum' => ['title', 'id']],
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
			$or[] = " menu.title LIKE '%$query_string%' ";
			self::$is_filtered = true;
		}

		$and[] = " menu.for = 'menu' ";


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['datecreated']))
			{
				$sort = \dash\str::mb_strtolower($data['sort']);
				$order = null;
				if($data['order'])
				{
					$order = \dash\str::mb_strtolower($data['order']);
				}

				$order_sort = " ORDER BY $sort $order";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY menu.id DESC";
		}

		$list = \lib\db\menu\search::list($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\lib\\app\\menu\\ready', 'row'], $list);

		return $list;
	}

}
?>