<?php
namespace dash\app\comment;

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
			'order'      => 'order',
			'sort'       => ['enum' => ['date', 'subprice', 'subtotal', 'subdiscount', 'item', 'qty','customer']],
			'status'     => ['enum' => ['publish', 'draft', 'removed']],
			'post_id'    => 'code',
			'product_id' => 'id',
			'parent'     => 'id',
			'limit'      => 'int',

		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$meta['join']  = [];
		$or            = [];
		$order_sort    = null;
		$meta['limit'] = 15;

		if($data['limit'])
		{
			$meta['limit'] = $data['limit'];
		}

		if($data['status'])
		{
			$and[] = " comments.status =  '$data[status]' ";
		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " comments.content LIKE '%$query_string%' ";

			self::$is_filtered = true;
		}



		if($data['sort'] && !$order_sort)
		{
			$order_sort = " ORDER BY $data[sort] $data[order]";
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY comments.id DESC ";
		}

		$list = \dash\db\comments\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\comment\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}
}
?>
