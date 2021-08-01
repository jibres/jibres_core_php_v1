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
			'order'        => 'order',
			'sort'         => 'string_50',
			'for'          => ['enum' => ['page','post','product', 'quote']],
			'status'       => ['enum' => ['approved','awaiting','unapproved','spam','deleted','filter']],
			'post_id'      => 'code',
			'user'         => 'code',
			'product_id'   => 'id',
			'parent'       => 'id',
			'limit'        => 'int',
			'pagination'   => 'y_n',
			'get_count'    => 'y_n',
			'website_mode' => 'bit',
			'parent_ids'   => 'string',
			'no_limit'     => 'bit',

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

		if($data['no_limit'])
		{
			unset($meta['limit']);
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

		$and[] = " ( comments.for IS NULL OR comments.for != 'quote' ) ";

		if($data['post_id'])
		{
			$data['post_id'] = \dash\coding::decode($data['post_id']);
			if($data['post_id'])
			{
				$and[] = " comments.post_id =  '$data[post_id]' ";
				self::$is_filtered = true;
			}
		}


		if($data['user'])
		{
			$data['user'] = \dash\coding::decode($data['user']);
			if($data['user'])
			{
				$and[] = " comments.user_id =  '$data[user]' ";
				self::$is_filtered = true;
			}
		}


		if($data['parent'])
		{
			$and[] = " comments.parent =  '$data[parent]' ";
			self::$is_filtered = true;
		}

		if($data['website_mode'])
		{
			$and[] = " comments.parent IS NULL ";
		}


		if($data['parent_ids'])
		{
			$and[] = " comments.parent IN ($data[parent_ids]) ";
		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " comments.content LIKE '%$query_string%' ";

			self::$is_filtered = true;
		}



		if($data['sort'] && !$order_sort)
		{
			if(\dash\app\comment\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort = " ORDER BY $data[sort] $data[order]";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY comments.id DESC ";
		}

		if($data['get_count'] === 'y')
		{
			$result = \dash\db\comments\search::get_count($and, $or, $order_sort, $meta);
			return $result;
		}
		else
		{
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



	public static function for_website_by_product_id($_id)
	{
		$args =
		[
			'product_id'   => $_id,
			'status'       => 'approved',
			'website_mode' => true,
			'limit'        => 100,
		];

		$list = self::list(null, $args, true);

		self::fill_answers($list);

		return $list;
	}


	private static function fill_answers(&$list)
	{
		if(!is_array($list))
		{
			$list = [];
		}

		$ids = array_column($list, 'id');
		$ids = array_filter($ids);
		$ids = array_unique($ids);
		$ids = array_map('floatval', $ids);
		if($ids)
		{
			$args_load_answer =
			[
				'parent_ids' => implode(',', $ids),
				'status'     => 'approved',
				'pagination' => 'n',
				'no_limit'   => true,
			];

			$load_answer = self::list(null, $args_load_answer, true);

			if(!is_array($load_answer))
			{
				$load_answer = [];
			}

			$list = array_combine(array_column($list, 'id'), $list);

			foreach ($load_answer as $key => $value)
			{
				if(isset($value['parent']) && isset($list[$value['parent']]))
				{
					if(!isset($list[$value['parent']]['answers']))
					{
						$list[$value['parent']]['answers'] = [];
					}

					$list[$value['parent']]['answers'][] = $value;
				}
			}
		}
	}


	public static function by_post($_id)
	{
		$args =
		[
			'post_id'      => $_id,
			'status'       => 'approved',
			'website_mode' => true,
			'limit'        => 100,
		];

		$list = self::list(null, $args, true);

		self::fill_answers($list);

		return $list;
	}


	public static function get_count_all()
	{
		$args =
		[
			'get_count' => 'y'
		];

		$list = self::list(null, $args, true);

		return $list;
	}


	public static function get_count_status($_status)
	{
		$args =
		[
			'get_count' => 'y',
			'status' => $_status,

		];

		$list = self::list(null, $args, true);

		return $list;
	}



}
?>
