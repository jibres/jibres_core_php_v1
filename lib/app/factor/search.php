<?php
namespace lib\app\factor;

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


	private static function factors_list($_type, $_query_string, $_args)
	{

		$condition =
		[
			'order'             => 'order',
			'sort'              => ['enum' => ['date', 'subprice', 'subtotal', 'subdiscount', 'item', 'qty','customer']],

			'customer'          => 'string',
			'type'              => ['enum' => ['sale', 'buy']],
			'product'           => 'id',
			'guestid'           => 'md5',

			'startdate'         => 'date',
			'enddate'           => 'date',
			'date'              => 'date',
			'time'              => 'time',
			'weekday'           => 'weekday',

			'subpricelarger'    => 'bigint',
			'subpriceless'      => 'bigint',
			'subpriceequal'     => 'bigint',
			'itemlarger'        => 'smallint',
			'itemless'          => 'smallint',
			'itemequal'         => 'smallint',
			'qtylarger'         => 'int',
			'qtyless'           => 'int',
			'qtyequal'          => 'int',
			'subtotallarger'    => 'bigint',
			'subtotalless'      => 'bigint',
			'subtotalequal'     => 'bigint',
			'subdiscountlarger' => 'bigint',
			'subdiscountless'   => 'bigint',
			'subdiscountequal'  => 'bigint',
			'subtotal'          => 'bigint',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		foreach ($condition as $key => $value)
		{
			if($value === 'bigint' && $data[$key])
			{
				$data[$key] = self::price_sum_up($data[$key]);
			}
			elseif($value === 'int' && $data[$key])
			{
				$data[$key] = \lib\number::up($data[$key]);
			}

		}


		$type               = $_type;
		$and                = [];
		$meta               = [];
		$or                 = [];
		$join_factordetails = false;
		$order_sort         = null;


		if($data['customer'])
		{
			if($data['customer'] === '-quick')
			{
				$and[] = ' factors.customer IS NULL ';
				self::$filter_args[T_('Customer')] = T_('Quick factor');
			}
			else
			{
				$id = \dash\validate::code($data['customer']);
				$id = \dash\coding::decode($id);
				if($id)
				{
					$and[] = " factors.customer = $id ";
					self::$filter_args['customer'] = '*'. T_('Customer');
					self::$is_filtered             = true;
				}
			}


		}

		if($data['type'])
		{
			$and[] = " factors.type = '$data[type]' ";
			self::$filter_args['type'] = '*'. T_('Type');
			self::$is_filtered             = true;
		}


		if($data['guestid'])
		{
			$and[] = " factors.guestid = '$data[guestid]' ";
			self::$filter_args['guestid'] = T_('Guest');
			self::$is_filtered             = true;
		}

		if($data['product'])
		{
			$join_factordetails               = true;
			$and[] = " factordetails.product_id = $data[product] ";
			self::$filter_args['product'] = '*'. T_('Product');
			self::$is_filtered                = true;
		}

		if($data['startdate'] && $data['enddate'])
		{
			$and[] = " DATE(factors.datecreated) >=  '$data[startdate]' ";
			$and[] = " DATE(factors.datecreated) <=  '$data[enddate]' ";

			self::$filter_args[T_('Start')] = $data['startdate'];
			self::$filter_args[T_('End')]  = $data['enddate'];
			self::$is_filtered          = true;
		}
		elseif($data['startdate'])
		{
			$and[] = " DATE(factors.datecreated) >=  '$data[startdate]' ";
			self::$filter_args[T_('Start')] = $data['startdate'];
			self::$is_filtered          = true;
		}
		elseif($data['enddate'])
		{
			$and[] = " DATE(factors.datecreated) <=  '$data[enddate]' ";
			self::$filter_args[T_('End')]  = $data['enddate'];
			self::$is_filtered          = true;
		}


		if($data['date'])
		{
			$and[] = " DATE(factors.datecreated) =  '$data[date]' ";
			self::$filter_args[T_('Date')] = $data['date'];
			self::$is_filtered = true;
		}

		if($data['time'])
		{
			$time  = $data['time'];
			$and[] =  " HOUR(factors.datecreated) =  HOUR('$time') ";
			$and[] =  " MINUTE(factors.datecreated) =  MINUTE('$time') ";

			self::$filter_args[T_('Time')] = $data['time'];
			self::$is_filtered = true;
		}

		if($data['weekday'])
		{
			$and[] = " DAYNAME(factors.datecreated) = '$data[weekday]' " ;
			self::$filter_args[T_('Weekday')] = $data['weekday'];
			self::$is_filtered = true;
		}

		if($data['subpricelarger'])
		{
			$and[] = " factors.subprice > $data[subpricelarger] ";
			self::$filter_args[T_('Subprice larger than')] = self::price_sum_down($data['subpricelarger']);
			self::$is_filtered = true;
		}

		if($data['subpriceless'])
		{
			$and[] = " factors.subprice <  $data[subpriceless] ";
			self::$filter_args[T_('Subprice less than')] = self::price_sum_down($data['subpriceless']);
			self::$is_filtered = true;
		}

		if($data['subpriceequal'])
		{
			$and[] = " factors.subprice =  $data[subpriceequal] ";
			self::$filter_args[T_('Subprice equal')] = self::price_sum_down($data['subpriceequal']);
			self::$is_filtered = true;
		}


		if($data['itemlarger'])
		{
			$and[] = " factors.item > $data[itemlarger] ";
			self::$filter_args[T_('Item larger than')] = $data['itemlarger'];
			self::$is_filtered = true;
		}

		if($data['itemless'])
		{
			$and[] = " factors.item <  $data[itemless] ";
			self::$filter_args[T_('Item less than')] = $data['itemless'];
			self::$is_filtered = true;
		}

		if($data['itemequal'])
		{
			$and[] = " factors.item =  $data[itemequal] ";
			self::$filter_args[T_('Item equal')] = $data['itemequal'];
			self::$is_filtered = true;
		}

		if($data['qtylarger'])
		{
			$and[] = " factors.qty > $data[qtylarger] ";
			self::$filter_args[T_('Qty larger than')] = \lib\number::down($data['qtylarger']);
			self::$is_filtered = true;
		}

		if($data['qtyless'])
		{
			$and[] = " factors.qty <  $data[qtyless] ";
			self::$filter_args[T_('Qty less than')] = \lib\number::down($data['qtyless']);
			self::$is_filtered = true;
		}

		if($data['qtyequal'])
		{
			$and[] = " factors.qty =  $data[qtyequal] ";
			self::$filter_args[T_('Qty equal')] = \lib\number::down($data['qtyequal']);
			self::$is_filtered = true;
		}

		if($data['subtotallarger'])
		{
			$and[] = " factors.subtotal > $data[subtotallarger] ";
			self::$filter_args[T_('Subtotal larger than')] = self::price_sum_down($data['subtotallarger']);
			self::$is_filtered = true;
		}

		if($data['subtotalless'])
		{
			$and[] = " factors.subtotal <  $data[subtotalless] ";
			self::$filter_args[T_('Subtotal less than')] = self::price_sum_down($data['subtotalless']);
			self::$is_filtered = true;
		}

		if($data['subtotalequal'])
		{
			$and[] = " factors.subtotal =  $data[subtotalequal] ";
			self::$filter_args[T_('Subtotal equal')] = self::price_sum_down($data['subtotalequal']);
			self::$is_filtered = true;
		}

		if($data['subtotal'])
		{
			$and[] = " factors.subtotal =  $data[subtotal] ";
			self::$filter_args[T_('Subtotal equal')] = self::price_sum_down($data['subtotal']);
			self::$is_filtered = true;
		}

		if($data['subdiscountlarger'])
		{
			$and[] = " factors.subdiscount > $data[subdiscountlarger] ";
			self::$filter_args[T_('Subdiscount larger than')] = self::price_sum_down($data['subdiscountlarger']);
			self::$is_filtered = true;
		}

		if($data['subdiscountless'])
		{
			$and[] = " factors.subdiscount <  $data[subdiscountless] ";
			self::$filter_args[T_('Subdiscount less than')] = self::price_sum_down($data['subdiscountless']);
			self::$is_filtered = true;
		}

		if($data['subdiscountequal'])
		{
			$and[] = " factors.subdiscount =  $data[subdiscountequal] ";
			self::$filter_args[T_('Subdiscount equal')] = self::price_sum_down($data['subdiscountequal']);
			self::$is_filtered = true;
		}

		$query_string = \dash\validate::search($_query_string);

		if($query_string)
		{
			$or[] = " factors.title LIKE '%$query_string%' ";


			$query_string_barcode = \dash\validate::barcode($query_string, false);

			if($query_string_barcode)
			{
				$or[] = " factors.id = '$query_string' ";
			}


			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			$order_sort = " ORDER BY $data[sort] $data[order]";
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY factors.id DESC ";
		}


		if($join_factordetails)
		{
			$list = \lib\db\factors\search::list_join_factordetails($and, $or, $order_sort, $meta);
		}
		else
		{
			$list = \lib\db\factors\search::list($and, $or, $order_sort, $meta);
		}


		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\factor\\ready', 'row'], $list);
			$list = array_map(['\\dash\\app', 'fix_avatar'], $list);
		}
		else
		{
			$list = [];
		}

		$filter_args_data = [];
		foreach (self::$filter_args as $key => $value)
		{
			$my_key = $key;
			if($key === 'customer')
			{
				$my_key = 'displayname';
			}
			if(isset($list[0][$my_key]) && substr($value, 0, 1)=== '*')
			{
				$filter_args_data[substr($value, 1)] = T_(ucfirst($list[0][$my_key]));
			}
			else
			{
				$filter_args_data[$my_key] = $value;
			}
		}

		self::$filter_message = \dash\app\sort::createFilterMsg($query_string, $filter_args_data);

		return $list;
	}



	public static function list($_string, $data)
	{
		$result = self::factors_list('detail', $_string, $data);

		$factors_id = array_column($result, 'id');
		$factors_id = array_unique($factors_id);
		$factors_id = array_filter($factors_id);

		if($factors_id)
		{
			// load all product in this factor
			$factors_id    = implode(',', $factors_id);
			$factor_detail = \lib\db\factordetails\get::by_multi_factor_id($factors_id);

			// load all product in this factors
			$products_id   = [];
			if(is_array($factor_detail))
			{
				$products_id = array_column($factor_detail, 'product_id');
				$products_id = array_unique($products_id);
				$products_id = array_filter($products_id);

				if($products_id)
				{
					$products_id = implode(',', $products_id);
					$product_detail = \lib\db\products\get::by_multi_id($products_id);
					if($product_detail && is_array($product_detail))
					{
						$result = self::merge_detail($result, $factor_detail, $product_detail);
					}
				}

			}
		}

		return $result;
	}


	private static function merge_detail($_result, $_factor_detail, $_produect_detail)
	{
		$product_detail = array_combine(array_column($_produect_detail, 'id'), $_produect_detail);

		$factor_product = [];
		foreach ($_factor_detail as $key => $value)
		{
			if(!isset($factor_product[$value['factor_id']]))
			{
				$factor_product[$value['factor_id']] = [];
			}
			$temp = [];
			if(isset($product_detail[$value['product_id']]['title']))
			{
				$temp_title = $product_detail[$value['product_id']]['title'];
				$temp['title'] = $temp_title;
			}

			$temp['count'] = \lib\number::down($value['count']);
			$temp['id']    = $value['product_id'];


			$factor_product[$value['factor_id']][] = $temp;
		}

		foreach ($_result as $key => $value)
		{
			if(isset($factor_product[$value['id']]))
			{
				$_result[$key]['productInFactor'] = $factor_product[$value['id']];
			}
		}

		return $_result;
	}



	private static function price_sum_up($_data)
	{
		return \lib\number::up(\lib\price::up($_data));
	}

	private static function price_sum_down($_data)
	{
		return \lib\number::down(\lib\price::down($_data));
	}




	public static function my_orders()
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
			$result = self::list(null, ['customer' => \dash\user::code()]);
		}
		else
		{
			$result = self::list(null, ['guestid' => \dash\user::get_user_guest()]);

		}

		return $result;

	}

}
?>
