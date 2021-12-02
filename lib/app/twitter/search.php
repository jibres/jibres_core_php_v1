<?php
namespace lib\app\twitter;

class search
{
	private static $filter_message = null;
	private static $filter_args    = [];
	private static $is_filtered    = false;


	public static function filter_message()
	{
		return self::$filter_message;
	}


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args)
	{

		$condition =
		[
			'order'    => 'order',
			'sort'     => 'string_50',
			'status'   => ['enum' => ['active', 'enable', 'draft', 'expired']],
		];

		$require = [];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;

		$order_sort  = null;

		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[]        = " twitter.code LIKE '%$query_string%'";

			self::$is_filtered = true;
		}

		$today = date("Y-m-d H:i:s");


		// if($data['type'] === 'amount')
		// {
		// 	$and[] = "twitter.apilogamount IS NOT NULL ";
		// 	self::$is_filtered = true;
		// }
		// elseif($data['type'] === 'percent')
		// {
		// 	$and[] = "twitter.apilogpercent IS NOT NULL ";
		// 	self::$is_filtered = true;

		// }

		if($data['sort'] && !$order_sort)
		{
			if(\lib\app\apilog\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort = " ORDER BY $data[sort] $data[order]";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY twitter.id DESC";
		}



		$list = \lib\db\twitter\search::list($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}

		return $list;
	}


}
?>