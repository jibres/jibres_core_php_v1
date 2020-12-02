<?php
namespace dash\app\log;

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
			'sort'      => ['enum' => ['id']],
			'status'    => ['enum' => ['enable']],
			'show_type' => ['enum' => ['user', 'admin']],
			'limit'     => 'int',
			'to'        => 'id',
			'from'      => 'id',
			'caller'    => 'string_200',
			'notif'     => 'bit',
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


		if($data['caller'])
		{
			$and[] = " logs.caller = '$data[caller]' ";
		}

		if($data['show_type'] === 'user')
		{
			$and[] = " logs.type =  'public' ";
		}
		else
		{
			/*nothing*/
		}

		if($data['from'])
		{
			$and[] = " logs.from =  $data[from] ";
		}


		if($data['to'])
		{
			$and[] = " logs.to =  $data[to] ";
		}

		if($data['notif'])
		{
			$and[] = " logs.notif = 1  ";
		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " logs.caller = '$query_string' ";
			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			$order_sort = " ORDER BY $data[sort] $data[order]";
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY logs.id DESC ";
		}

		$list = \dash\db\logs\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\log', 'ready'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}


	public static function lates_log_caller($_caller)
	{
		$args           = [];
		$args['caller'] =  $_caller;
		$args['limit']  = 5;
		return self::list(null, $args);
	}

}
?>
