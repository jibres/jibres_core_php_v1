<?php
namespace dash\app\terms;


class search
{
	private static $is_filtered    = false;



	public static function is_filtered()
	{
		return self::$is_filtered;
	}




	public static function list($_query_string = null, $_args = [])
	{
		$condition =
		[
			'order'      => 'order',
			'sort'       => ['enum' => ['title']],
			'pagination' => 'bit',
			'type'       => ['enum' => ['cat', 'tag']],
			'limit'      => 'int',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and         = [];
		$meta        = [];
		$or          = [];


		if($data['type'])
		{
			$and[] = " terms.type = '$data[type]' ";
		}

		$meta['limit'] = 20;

		if($data['limit'])
		{
			$meta['limit'] = $data['limit'];
		}

		if(array_key_exists('pagination', $_args) && $_args['pagination'] === false)
		{
			$meta['pagination'] = false;
		}

		$order_sort  = null;


		$query_string = \dash\validate::search($_query_string, false);


		if($query_string)
		{
			$or[]        = " terms.title LIKE '%$query_string%'";

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			$sort = mb_strtolower($data['sort']);
			$order = null;
			if($data['order'])
			{
				$order = mb_strtolower($data['order']);
			}

			$order_sort = " ORDER BY $sort $order";
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY terms.id DESC";
		}

		$and[] = " terms.status != 'deleted' ";

		$list = \dash\db\terms\search::list($and, $or, $order_sort, $meta);


		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\terms\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}
}
?>