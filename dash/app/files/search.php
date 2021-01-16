<?php
namespace dash\app\files;


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
			'type'       => ['enum' => ['cat']],
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and         = [];
		$meta        = [];
		$or          = [];


		if($data['type'])
		{
			$and[] = " files.type = '$data[type]' ";
		}

		$meta['limit'] = 15;
		if(array_key_exists('pagination', $_args) && $_args['pagination'] === false)
		{
			$meta['pagination'] = false;
		}

		$order_sort  = null;


		$query_string = \dash\validate::search($_query_string, false);


		if($query_string)
		{
			$or[]        = " files.title LIKE '%$query_string%'";

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
			$order_sort = " ORDER BY files.id DESC";
		}

		$and[] = " files.status != 'deleted' ";

		$list = \dash\db\files::list($and, $or, $order_sort, $meta);


		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\files\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}
}
?>