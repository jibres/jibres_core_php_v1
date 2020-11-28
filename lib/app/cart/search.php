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

		\dash\permission::access('manageCart');

		$condition =
		[
			'order'   => 'order',
			'sort'    => ['enum' => ['date', 'item', 'count']],
			'hu'      => 'y_n',
			'user_id' => 'code',
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


		if($data['hu'] === 'y')
		{
			$and[] = " cart.user_id IS NOT NULL ";
			self::$filter_args[T_("User login and add cart")] = ' ';
			self::$is_filtered = true;
		}
		elseif($data['hu'] === 'n')
		{
			$and[] = " cart.user_id IS NULL ";
			self::$filter_args[T_("Guest user add cart")] = ' ';
			self::$is_filtered = true;
		}


		$query_string = \dash\validate::search($_query_string, false);


		if($query_string)
		{
			$mobile = null;

			if(is_numeric($query_string))
			{
				$mobile = \dash\validate::mobile($query_string, false);
			}

			if($mobile)
			{
				$search_user_id = \dash\db\users::get_by_mobile($mobile);
				if(isset($search_user_id['id']))
				{
					$or[] = " cart.user_id = '$search_user_id[id]' ";
				}

			}
			else
			{
				$or[] = " products.title LIKE '%$query_string%' ";
				$or[] = " users.mobile LIKE '%$query_string%' ";
				$or[] = " users.displayname LIKE '%$query_string%' ";

			}

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			$sort = " MAX(cart.datecreated) ";
			switch ($data['sort'])
			{
				case 'item':
					$sort = " COUNT(*) ";
					break;

				case 'count':
					$sort = " SUM(cart.count) ";
					break;

				case 'date':
					$sort = " MAX(cart.datecreated) ";
					break;

			}


			$order = null;
			if($data['order'])
			{
				$order = mb_strtolower($data['order']);
			}

			$order_sort = " ORDER BY $sort $order";
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY MAX(cart.datecreated) DESC";
		}

		if($data['user_id'])
		{
			$data['user_id'] = \dash\coding::decode($data['user_id']);

			$and[] = " cart.user_id = $data[user_id] ";
		}

		$list = \lib\db\cart\search::list($and, $or, $order_sort, $meta);


		if(!is_array($list))
		{
			$list = [];
		}


		$user_ids = array_column($list, 'user_id');
		$user_ids = array_filter($user_ids);
		$user_ids = array_unique($user_ids);

		$user_detail = [];

		if(!empty($user_ids))
		{
			$user_detail = \dash\db\users::get_by_ids_summary(implode(',', $user_ids));
			if(!is_array($user_detail))
			{
				$user_detail = [];
			}

			$user_detail = array_map(['\\dash\\app\\user', 'ready'], $user_detail);

			$user_detail = array_combine(array_column($user_detail, 'id'), $user_detail);
		}

		$list = array_map(['\\lib\\app\\cart\\ready', 'row'], $list);

		foreach ($list as $key => $value)
		{
			if(isset($value['user_id']) && isset($user_detail[$value['user_id']]))
			{
				$list[$key]['user_detail'] = $user_detail[$value['user_id']];
			}
			else
			{
				$list[$key]['user_detail'] = \dash\app::fix_avatar([]);
			}
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
		if(!\dash\user::id())
		{
			if(!\dash\user::get_user_guest())
			{
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}
		}

		if(\dash\user::id())
		{
			return self::detail(\dash\user::code());
		}
		else
		{
			return self::detail(null, \dash\user::get_user_guest());
		}
	}


	public static function my_detail_summary($_detail)
	{
		if(!is_array($_detail))
		{
			return false;
		}

		$subtotal = 0;
		$discount = 0;
		$count    = 0;
		$subvat   = 0;

		foreach ($_detail as $key => $value)
		{
			if(isset($value['allow_shop']) && $value['allow_shop'])
			{
				$count++;
				$subtotal += floatval($value['count']) * floatval($value['product_price']);
				$subvat   += floatval($value['count']) * floatval($value['vatprice']);
				$discount += floatval($value['count']) * floatval($value['discount']);
			}
		}

		$shipping_value = 0;
		$shipping = \lib\app\setting\get::shipping_setting();

		if(isset($shipping['sendbypost']) && $shipping['sendbypost'] && isset($shipping['sendbypostprice']) && $shipping['sendbypostprice'])
		{
			if(isset($shipping['freeshipping']) && $shipping['freeshipping'] && isset($shipping['freeshippingprice']) && $shipping['freeshippingprice'])
			{
				if(floatval($subtotal) >= floatval($shipping['freeshippingprice']))
				{
					$shipping_value = 0;
				}
				else
				{
					$shipping_value = floatval($shipping['sendbypostprice']);
				}
			}
			else
			{
				$shipping_value = floatval($shipping['sendbypostprice']);
			}
		}

		$result             = [];
		$result['count']    = $count;
		$result['subtotal'] = $subtotal;
		$result['shipping'] = $shipping_value;
		$result['discount'] = $discount;
		$result['subvat'] = $subvat;
		$result['total']    = ($result['subtotal'] + $result['shipping']) - $result['discount'] + $result['subvat'];

		return $result;

	}



	public static function detail($_user_id = null, $_guestid = null)
	{

		$and                = [];
		if($_user_id)
		{
			$user_id = \dash\coding::decode($_user_id);

			if(!$user_id)
			{
				\dash\notif::error(T_("Invalid user"));
				return false;
			}
			$and[]              = " cart.user_id = $user_id " ;
		}
		else
		{
			$and[]              = " cart.guestid = '$_guestid' " ;

		}

		$or                 = null;
		$order              = null;
		$meta               = [];
		$meta['pagination'] = false;


		$user_cart = \lib\db\cart\search::detail($and, $or, $order, $meta);


		if(!$user_cart)
		{
			return null;
		}

		if(\dash\engine\content::get_name() === 'business')
		{
			if($_user_id)
			{
				\lib\db\cart\update::set_view_user_id($user_id);
			}
			elseif($_guestid)
			{
				\lib\db\cart\update::set_view_guestid($_guestid);
			}
		}

		$user_cart = array_map(['\\lib\\app\\cart\\ready', 'row'], $user_cart);


		$must_remove = [];
		foreach ($user_cart as $key => $value)
		{
			if(isset($value['allow_shop']) && $value['allow_shop'])
			{
				// nothing
			}
			else
			{
				$must_remove[] = $value['product_id'];
			}
		}

		if($must_remove)
		{
			if($_user_id)
			{
				\lib\db\cart\delete::autoremove_product_user_id(implode(',', $must_remove), $user_id);
			}
			elseif($_guestid)
			{
				\lib\db\cart\delete::autoremove_product_guestid(implode(',', $must_remove), $_guestid);
			}
		}


		return $user_cart;
	}
}
?>