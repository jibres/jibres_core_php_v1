<?php
namespace lib\app\gift\lookup;

class search
{

	private static $is_filtered    = false;



	public static function is_filtered()
	{
		return self::$is_filtered;
	}

	public static function last_5_lookup()
	{
		return self::list(null, ['limit' => 5, 'pagination' => 'n' , 'sort' => 'id', 'order' => 'desc' ]);
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
			'order'      => 'order',
			'sort'       => ['enum' => ['id', 'datecreated']],
			'pagination' => 'y_n',
			'limit'      => 'int',
			'gift_id'      => 'code',
		];

		$require = [];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;

		if($data['limit'])
		{
			$meta['limit'] = $data['limit'];
		}

		if($data['pagination'] === 'n')
		{
			$meta['pagination'] = false;
		}

		if($data['gift_id'])
		{
			$gift_id = \dash\coding::decode($data['gift_id']);
			if($gift_id)
			{
				$and[] = " giftlookup.gift_id = $gift_id";

				self::$is_filtered = true;
			}
		}


		$order_sort  = null;


		$query_string = \dash\validate::search($_query_string, false);


		if($query_string)
		{
			$or[]        = " gift.code LIKE '%$query_string%'";



			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], [ 'id']))
			{

				$sort = mb_strtolower($data['sort']);
				$order = null;
				if($data['order'])
				{
					$order = mb_strtolower($data['order']);
				}

				$order_sort = " ORDER BY $sort $order";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY giftlookup.id DESC";
		}

		$list = \lib\db\giftlookup\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\gift\\lookup\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}


}
?>