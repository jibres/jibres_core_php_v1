<?php
namespace dash\app\posts;

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
			'order'        => 'order',
			'sort'         => ['enum' => ['date', 'subprice', 'subtotal', 'subdiscount', 'item', 'qty','customer']],
			'subtype'      => ['enum' => ['standard', 'gallery', 'video', 'audio']],
			'status'       => ['enum' => ['publish', 'draft', 'removed']],
			'user_code'    => 'code',
			'type'         => ['enum' => ['post', 'page', 'help']],
			'parent'       => 'string_100',
			'language'     => 'language',
			'limit'        => 'int',
			'cat_id'       => 'code',
			'tag_id'       => 'code',
			'website_mode' => 'bit',
			'pagination'   => 'y_n',

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

		if($data['pagination'] === 'n')
		{
			$meta['pagination'] = false;
		}

		if($data['limit'])
		{
			$meta['limit'] = $data['limit'];
		}


		if($data['type'])
		{
			$and[] = " posts.type =  '$data[type]' ";
		}


		if($data['subtype'])
		{
			$and[] = " posts.subtype =  '$data[subtype]' ";
		}

		if($data['language'])
		{
			$and[] = " posts.language =  '$data[language]' ";
		}

		if($data['status'])
		{
			$and[] = " posts.status =  '$data[status]' ";
		}


		if($data['tag_id'])
		{
			$data['tag_id'] = \dash\coding::decode($data['tag_id']);

			if($data['tag_id'])
			{
				$and[]   = " termusages.term_id =  $data[tag_id] ";
				$meta['join']['join_on_termusages'] = " INNER JOIN termusages ON termusages.post_id = posts.id AND termusages.type = 'tag' ";
			}
		}

		if($data['cat_id'])
		{
			$data['cat_id'] = \dash\coding::decode($data['cat_id']);

			if($data['cat_id'])
			{
				$and[]   = " termusages.term_id =  $data[cat_id] ";
				$meta['join']['join_on_termusages'] = " INNER JOIN termusages ON termusages.post_id = posts.id AND termusages.type = 'cat' ";
			}
		}

		if($data['website_mode'])
		{
			$time = time();
			$and[] = " UNIX_TIMESTAMP(posts.publishdate) <= $time ";
		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " posts.title LIKE '%$query_string%' ";

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			$order_sort = " ORDER BY $data[sort] $data[order]";
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY posts.id DESC ";
		}

		$list = \dash\db\posts\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\posts\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}


	public static function random_help_center()
	{
		$language = \dash\language::current();
		$list = \dash\db\posts\search::random_help_center($language);
		if(!is_array($list))
		{
			$list = [];
		}
		$list = array_map(['\\dash\\app\\posts\\ready', 'row'], $list);

		return $list;

	}


	public static function lates_post($_args = [])
	{
		if(!isset($_args['limit']))
		{
			$_args['limit'] = 5;
			$_args['end_limit'] = 5;
		}

		$_args['order_raw'] = 'posts.id DESC';
		$_args['pagenation'] = false;
		$_args['status'] = 'publish';

		$list = \dash\db\posts::search(null, $_args);

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\posts\\ready', 'row'], $list);
		}

		return $list;
	}

}
?>
