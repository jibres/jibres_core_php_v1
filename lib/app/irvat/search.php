<?php
namespace lib\app\irvat;

class search
{
	private static $filter_message = null;
	private static $filter_args    = [];
	private static $is_filtered    = false;
	private static $and = [];
	private static $or = [];


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

		return self::get_list($_query_string, $_args);
	}


	public static function list_admin($_query_string, $_args)
	{
		return self::get_list($_query_string, $_args);
	}


	private static function get_list($_query_string, $_args)
	{


		$condition =
		[
			'order'     => 'order',
			'sort'      => ['enum' => ['title', 'factordate', 'id']],
			'domainlen' => 'smallint',
			'available' => 'bit',
			'season'    => 'smallint',
			'year'      => 'int',
			'seller'    => 'code',
			'customer'  => 'code',
			'vat'       => 'bit',
			'official'  => 'bit',
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

		$meta['limit'] = 30;


		$order_sort  = null;


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\validate::search($_query_string);


		if($query_string)
		{
			$or[]        = " ir_vat.title LIKE '$query_string%'";
			self::$is_filtered = true;
		}

		if($data['season'])
		{
			$and[] = " ir_vat.season = $data[season] ";
			self::$is_filtered = true;
		}

		if($data['year'])
		{
			$and[] = " ir_vat.year = $data[year] ";
			self::$is_filtered = true;
		}

		if($data['seller'])
		{
			$data['seller'] = \dash\coding::decode($data['seller']);
			$and[] = " ir_vat.seller = $data[seller] ";
			self::$is_filtered = true;
		}

		if($data['vat'])
		{
			$and[] = " ir_vat.vat = 1 ";
			self::$is_filtered = true;
		}

		if($data['official'])
		{
			$and[] = " ir_vat.official = 1 ";
			self::$is_filtered = true;
		}


		if($data['customer'])
		{
			$data['customer'] = \dash\coding::decode($data['customer']);
			$and[] = " ir_vat.customer = $data[customer] ";
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
			$order_sort = " ORDER BY ir_vat.id DESC";
		}

		self::$and = $and;
		self::$or = $or;

		$list = \lib\db\irvat\search::list($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}

		$seller      = array_column($list, 'seller');
		$customer    = array_column($list, 'customer');
		$users_id = array_merge($seller, $customer);

		$users_id = array_filter($users_id);
		$users_id = array_unique($users_id);
		$users_id = array_values($users_id);

		$load_some_user = [];
		$load_some_user_legal = [];

		if($users_id)
		{
			$load_some_user = \dash\db\users\get::by_multi_id(implode(',', $users_id));

			if(!is_array($load_some_user))
			{
				$load_some_user = [];
			}

			$load_some_user = array_combine(array_column($load_some_user, 'id'), $load_some_user);

			$load_some_user_legal = \dash\db\userlegal\get::by_multi_id(implode(',', $users_id));

			if(!is_array($load_some_user_legal))
			{
				$load_some_user_legal = [];
			}

			$load_some_user_legal = array_combine(array_column($load_some_user_legal, 'user_id'), $load_some_user_legal);
		}

		foreach ($list as $key => $value)
		{

			if(isset($value['seller']) && $value['seller'])
			{
				if(isset($load_some_user[$value['seller']]))
				{
					$user_detail = $load_some_user[$value['seller']];
					$user_detail = \dash\app\user::ready($user_detail);
					$list[$key]['user_detail'] = $user_detail;
				}

				if(isset($load_some_user_legal[$value['seller']]))
				{
					$list[$key]['user_detail_legal'] = $load_some_user_legal[$value['seller']];
				}
			}
			elseif(isset($value['customer']) && $value['customer'])
			{
				if(isset($load_some_user[$value['customer']]))
				{
					$user_detail = $load_some_user[$value['customer']];
					$user_detail = \dash\app\user::ready($user_detail);
					$list[$key]['user_detail'] = $user_detail;
				}

				if(isset($load_some_user_legal[$value['customer']]))
				{
					$list[$key]['user_detail_legal'] = $load_some_user_legal[$value['customer']];
				}
			}
			else
			{

				$list[$key]['user_detail'] = \dash\app::fix_avatar([]);
			}
		}

		$list = array_map(['\\lib\\app\\irvat\\ready', 'row'], $list);


		$filter_args_data = [];

		foreach (self::$filter_args as $key => $value)
		{
			if(isset($list[0][$key]) && substr($value, 0, 1) === '*')
			{
				$filter_args_data[substr($value, 1)] = $list[0][$key];
			}
			else
			{
				$filter_args_data[$key] = $value;
			}
		}

		self::$filter_message = \dash\app\sort::createFilterMsg($query_string, $filter_args_data);

		return $list;
	}


	public static function summary()
	{
		$summary = \lib\db\irvat\search::summary(self::$and, self::$or);

		if(isset($summary['sumvat']))
		{
			$sumvat_raw = floatval($summary['sumvat']);
			$summary['sumvat6'] = round($sumvat_raw * 0.6666666);
			$summary['sumvat3'] = round($sumvat_raw * 0.3333333);
		}

		return $summary;

	}


}
?>