<?php
namespace dash\app\comment;

class search
{

	private static $is_filtered    = false;


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args, $_force = false)
	{
		if(!$_force)
		{
			\dash\permission::access('cmsCommentView');
		}

		$condition =
		[
			'order'      => 'order',
			'sort'       => ['enum' => ['id']],
			'for'        => ['enum' => ['page','post','product']],
			'status'     => ['enum' => ['approved','awaiting','unapproved','spam','deleted','filter']],
			'post_id'    => 'code',
			'product_id' => 'id',
			'parent'     => 'id',
			'limit'      => 'int',
			'pagination' => 'y_n',

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

		if($data['pagination'] === 'n')
		{
			$meta['pagination'] = false;
		}

		if($data['status'])
		{
			$and[] = " comments.status =  '$data[status]' ";
			self::$is_filtered = true;
		}

		if($data['product_id'])
		{
			$and[] = " comments.product_id =  '$data[product_id]' ";
			self::$is_filtered = true;
		}


		if($data['post_id'])
		{
			$data['post_id'] = \dash\coding::decode($data['post_id']);
			if($data['post_id'])
			{
				$and[] = " comments.post_id =  '$data[post_id]' ";
				self::$is_filtered = true;
			}
		}


		if($data['parent'])
		{
			$and[] = " comments.parent =  '$data[parent]' ";
			self::$is_filtered = true;
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


	public static function lates_comment()
	{
		$args =
		[
			'limit'      => 5,
			'pagination' => 'n',
		];

		$list = self::list(null, $args);
		return $list;
	}



	public static function by_product($_id)
	{
		$args =
		[
			'product_id' => $_id,
			'status' => 'approved',
		];

		$list = self::list(null, $args, true);
		return $list;
	}


	public static function by_post($_id)
	{
		$args =
		[
			'post_id' => $_id,
			'status' => 'approved',
		];

		$list = self::list(null, $args, true);
		return $list;
	}
}
?>
