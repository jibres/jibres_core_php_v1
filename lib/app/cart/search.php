<?php
namespace lib\app\cart;


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
			'order'     => 'order',
			'sort'      => ['enum' => ['datecreated']],
			'user_id'   => 'code',
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);



		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;
		// $meta['pagination'] = false;


		$order_sort  = null;


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\validate::search($_query_string);


		if($query_string)
		{
			$mobile = null;

			if(is_numeric($query_string))
			{
				$mobile = \dash\validate::mobile($query_string, false);
			}

			if($mobile)
			{
				$or[] = " users.mobile = '$mobile' ";
			}
			else
			{
				$or[] = " users.displayname LIKE '%$query_string%' ";
			}

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['datecreated']))
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
			// $order_sort = " ORDER BY cart.datecreated ASC";
		}



		if($data['user_id'])
		{
			$data['user_id'] = \dash\coding::decode($data['user_id']);

			$and[] = " cart.user_id = $data[user_id] ";
		}

		$list = \lib\db\cart\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\cart\\ready', 'row'], $list);

		}
		else
		{
			$list = [];
		}


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


	public static function my_detail()
	{
		if(\dash\user::id())
		{
			return self::detail(\dash\user::code());
		}
	}



	public static function detail($_user_id)
	{
		if(!\dash\user::id())
		{
			// save in session
			// in api we have the user id
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$user_id = \dash\coding::decode($_user_id);

		if(!$user_id)
		{
			\dash\notif::error(T_("Invalid user"));
			return false;
		}

		$and                = [];
		$and[]              = " cart.user_id = $user_id " ;
		$or                 = null;
		$order              = null;
		$meta               = [];
		$meta['pagination'] = false;

		$user_cart = \lib\db\cart\search::detail($and, $or, $order, $meta);

		if(!$user_cart)
		{
			return null;
		}

		$user_cart = array_map(['\\lib\\app\\cart\\ready', 'row'], $user_cart);

		return $user_cart;
	}
}
?>