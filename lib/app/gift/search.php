<?php
namespace lib\app\gift;

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
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$condition =
		[
			'order'    => 'order',
			'sort'     => 'string_50',
			'status'   => ['enum' => ['active', 'enable', 'draft', 'expired']],
			'user'     => ['enum' => ['special', 'havelimit',]],
			'type'     => ['enum' => ['amount',  'percent']],
			'forusein' => ['enum' => ['any',  'domain', 'store', 'sms', 'ir_domain', 'ir_domain_1', 'ir_domain_5',]],
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
			$or[]        = " gift.code LIKE '%$query_string%'";

			self::$is_filtered = true;
		}

		$today = date("Y-m-d H:i:s");

		if($data['status'] === 'active')
		{
			$and[] = "(gift.dateexpire IS NULL OR gift.dateexpire > '$today') ";
			$and[] = "gift.status = 'enable'  ";

			self::$is_filtered = true;
		}
		elseif($data['status'] === 'expired')
		{
			$and[] = "gift.dateexpire IS NOT NULL AND gift.dateexpire < '$today' ";

			self::$is_filtered = true;
		}
		elseif($data['status'])
		{
			$and[] = "gift.status = '$data[status]' ";
			self::$is_filtered = true;
		}

		if($data['forusein'])
		{
			$and[] = "gift.forusein = '$data[forusein]' ";
			self::$is_filtered = true;
		}


		if($data['user'] === 'special')
		{
			$and[] = "gift.dedicated IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['user'] === 'havelimit')
		{
			$and[] = "gift.usagetotal IS NOT NULL ";
			self::$is_filtered = true;

		}


		if($data['type'] === 'amount')
		{
			$and[] = "gift.giftamount IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['type'] === 'percent')
		{
			$and[] = "gift.giftpercent IS NOT NULL ";
			self::$is_filtered = true;

		}

		if($data['sort'] && !$order_sort)
		{
			if(\lib\app\gift\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort = " ORDER BY $data[sort] $data[order]";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY gift.id DESC";
		}



		$list = \lib\db\gift\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\gift\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}


}
?>