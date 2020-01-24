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


	private static function factors_list($_type, $_query_string, $_args, $_where = [])
	{
		$default_args =
		[
			'order'                => null,
			'sort'                 => null,
			'type'                 => null,
			'customer'             => null,
			'product'              => null,
			'startdate'            => null,
			'enddate'              => null,
			'date'                 => null,
			'time'                 => null,
			'weekday'              => null,
			'subpricelarger'      => null,
			'subpriceless'        => null,
			'subpriceequal'       => null,
			'itemlarger'           => null,
			'itemless'             => null,
			'itemequal'            => null,
			'qtylarger'            => null,
			'qtyless'              => null,
			'qtyequal'             => null,
			'subtotallarger' => null,
			'subtotalless'   => null,
			'subtotalequal'  => null,
			'subdiscountlarger' => null,
			'subdiscountless'   => null,
			'subdiscountequal'  => null,
			'subtotal'       => null,


		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		if(!is_array($_where))
		{
			$_where = [];
		}

		$_args              = array_merge($default_args, $_args);
		$type               = $_type;
		$and                = [];
		$meta               = [];
		$or                 = [];
		$join_factordetails = false;
		$order_sort         = null;


		if($_args['customer'] && is_numeric($_args['customer']))
		{
			$and['factors.customer']       = $_args['customer'];
			self::$filter_args['customer'] = '*'. T_('Customer');
			self::$is_filtered             = true;
		}


		if($_args['type'] && is_string($_args['type']))
		{
			$and['factors.type']       = $_args['type'];
			self::$filter_args['type'] = '*'. T_('Customer');
			self::$is_filtered             = true;
		}

		if(isset($and['factors.customer']) && $and['factors.customer'] === '-quick')
		{
			$and['factors.customer']       = null;
			self::$filter_args['customer'] = T_('Quick factor');
			self::$is_filtered             = true;
		}



		if($_args['product'] && is_numeric($_args['product']))
		{
			$join_factordetails               = true;
			$and['factordetails.product_id'] = $_args['product'];
			self::$filter_args['customer']    = '*'. T_('Customer');
			self::$is_filtered                = true;
		}


		$startdate    = null;
		$enddate      = null;


		if($_args['startdate'])
		{
			$startdate                 = $_args['startdate'];

			self::$filter_args['start'] = $_args['startdate'];
			$startdate                 = \dash\number::clean($startdate);
			$startdate = \dash\date::db($startdate);
			if($startdate)
			{
				if(\dash\utility\jdate::is_jalali($startdate))
				{
					$startdate = \dash\utility\jdate::to_gregorian($startdate);
				}
				\dash\data::startdateEn($startdate);
			}
		}


		if($_args['enddate'])
		{
			$enddate                 = $_args['enddate'];
			self::$filter_args['End'] = $_args['enddate'];
			self::$is_filtered = true;
			$enddate                 = \dash\number::clean($enddate);
			$enddate = \dash\date::db($enddate);
			if($enddate)
			{
				if(\dash\utility\jdate::is_jalali($enddate))
				{
					$enddate = \dash\utility\jdate::to_gregorian($enddate);
				}
				\dash\data::enddateEn($enddate);
			}
		}


		if($startdate && $enddate)
		{
			$and['DATE(factors.datecreated)'] = [">=", " '$startdate' "];
			$and['DATE(factors.datecreated)'] = ["<=", " '$enddate' "];
		}
		elseif($startdate)
		{
			$and['DATE(factors.datecreated)'] = [">=", " '$startdate' "];
		}
		elseif($enddate)
		{
			$and['DATE(factors.datecreated)'] = ["<=", " '$enddate' "];
		}


		if($_args['date'])
		{
			$date                 = $_args['date'];

			$date                 = \dash\number::clean($date);
			$date = \dash\date::db($date);
			if($date)
			{
				if(\dash\utility\jdate::is_jalali($date))
				{
					$date = \dash\utility\jdate::to_gregorian($date);
				}
				\dash\data::dateEn($date);

				$and['DATE(factors.datecreated)'] = ["=", " '$date' "];

				self::$filter_args['date'] = $_args['date'];
				self::$is_filtered = true;
			}

		}

		if($_args['time'])
		{
			$time                 = $_args['time'];
			self::$filter_args['time'] = $_args['time'];
			self::$is_filtered = true;
			$time                 = \dash\number::clean($time);
			$time = \dash\date::make_time($time);
			if($time)
			{
				$and['HOUR(factors.datecreated)']   = ["=", " HOUR('$time')"];
				$and['MINUTE(factors.datecreated)'] = ["=", " MINUTE('$time')"];
				self::$filter_args['time'] = $_args['time'];
				self::$is_filtered = true;
			}

		}

		$weekday = $_args['weekday'];
		if($weekday && in_array($weekday, ['saturday', 'sunday','monday','tuesday','wednesday','thursday','friday']))
		{
			$and["DAYNAME(factors.datecreated)"] = $weekday;
			self::$filter_args['weekday'] = $_args['weekday'];
			self::$is_filtered = true;
		}

		$subpricelarger = $_args['subpricelarger'];
		if($subpricelarger)
		{
			$subpricelarger = \dash\number::clean($subpricelarger);
			if($subpricelarger && is_numeric($subpricelarger))
			{
				$and['factors.subprice'] = [" > ", " $subpricelarger "];
				self::$filter_args['subprice larger than'] = $subpricelarger;
				self::$is_filtered = true;
			}
		}

		$subpriceless = $_args['subpriceless'];
		if($subpriceless)
		{
			$subpriceless = \dash\number::clean($subpriceless);
			if($subpriceless && is_numeric($subpriceless))
			{
				$and['factors.subprice'] = [" < ", " '$subpriceless' "];
				self::$filter_args['subprice less than'] = $subpriceless;
				self::$is_filtered = true;
			}
		}

		$subpriceequal = $_args['subpriceequal'];
		if($subpriceequal)
		{
			$subpriceequal = \dash\number::clean($subpriceequal);
			if($subpriceequal && is_numeric($subpriceequal))
			{
				$and['factors.subprice'] = [" = ", " '$subpriceequal' "];
				self::$filter_args['subprice equal'] = $subpriceequal;
				self::$is_filtered = true;
			}
		}

		$itemlarger = $_args['itemlarger'];
		if($itemlarger)
		{
			$itemlarger = \dash\number::clean($itemlarger);
			if($itemlarger && is_numeric($itemlarger))
			{
				$and['factors.item'] = [" > ", " '$itemlarger' "];
				self::$filter_args['item larger than'] = $itemlarger;
				self::$is_filtered = true;
			}
		}

		$itemless = $_args['itemless'];
		if($itemless)
		{
			$itemless = \dash\number::clean($itemless);
			if($itemless && is_numeric($itemless))
			{
				$and['factors.item'] = [" < ", " '$itemless' "];
				self::$filter_args['item less than'] = $itemless;
				self::$is_filtered = true;
			}
		}

		$itemequal = $_args['itemequal'];
		if($itemequal)
		{
			$itemequal = \dash\number::clean($itemequal);
			if($itemequal && is_numeric($itemequal))
			{
				$and['factors.item'] = [" = ", " '$itemequal' "];
				self::$filter_args['item equal'] = $itemequal;
				self::$is_filtered = true;
			}
		}

		$qtylarger = $_args['qtylarger'];
		if($qtylarger)
		{
			$qtylarger = \dash\number::clean($qtylarger);
			if($qtylarger && is_numeric($qtylarger))
			{
				$and['factors.qty'] = [" > ", " '$qtylarger' "];
				self::$filter_args['qty larger than'] = $qtylarger;
				self::$is_filtered = true;
			}
		}

		$qtyless = $_args['qtyless'];
		if($qtyless)
		{
			$qtyless = \dash\number::clean($qtyless);
			if($qtyless && is_numeric($qtyless))
			{
				$and['factors.qty'] = [" < ", " '$qtyless' "];
				self::$filter_args['qty less than'] = $qtyless;
				self::$is_filtered = true;
			}
		}

		$qtyequal = $_args['qtyequal'];
		if($qtyequal)
		{
			$qtyequal = \dash\number::clean($qtyequal);
			if($qtyequal && is_numeric($qtyequal))
			{
				$and['factors.qty'] = [" = ", " '$qtyequal' "];
				self::$filter_args['qty equal'] = $qtyequal;
				self::$is_filtered = true;
			}
		}

		$subtotallarger = $_args['subtotallarger'];
		if($subtotallarger)
		{
			$subtotallarger = \dash\number::clean($subtotallarger);
			if($subtotallarger && is_numeric($subtotallarger))
			{
				$and['factors.subtotal'] = [" > ", " '$subtotallarger' "];
				self::$filter_args['subtotal larger than'] = $subtotallarger;
				self::$is_filtered = true;
			}
		}

		$subtotalless = $_args['subtotalless'];
		if($subtotalless)
		{
			$subtotalless = \dash\number::clean($subtotalless);
			if($subtotalless && is_numeric($subtotalless))
			{
				$and['factors.subtotal'] = [" < ", " '$subtotalless' "];
				self::$filter_args['subtotal less than'] = $subtotalless;
				self::$is_filtered = true;
			}
		}

		$subtotalequal = $_args['subtotalequal'];
		if($subtotalequal)
		{
			$subtotalequal = \dash\number::clean($subtotalequal);
			if($subtotalequal && is_numeric($subtotalequal))
			{
				$and['factors.subtotal'] = [" = ", " '$subtotalequal' "];
				self::$filter_args['subtotal equal'] = $subtotalequal;
				self::$is_filtered = true;
			}
		}


		$subdiscountlarger = $_args['subdiscountlarger'];
		if($subdiscountlarger)
		{
			$subdiscountlarger = \dash\number::clean($subdiscountlarger);
			if($subdiscountlarger && is_numeric($subdiscountlarger))
			{
				$and['factors.subdiscount'] = [" > ", " '$subdiscountlarger' "];
				self::$filter_args['subdiscount larger than'] = $subdiscountlarger;
				self::$is_filtered = true;
			}
		}

		$subdiscountless = $_args['subdiscountless'];
		if($subdiscountless)
		{
			$subdiscountless = \dash\number::clean($subdiscountless);
			if($subdiscountless && is_numeric($subdiscountless))
			{
				$and['factors.subdiscount'] = [" < ", " '$subdiscountless' "];
				self::$filter_args['subdiscount less than'] = $subdiscountless;
				self::$is_filtered = true;
			}
		}

		$subdiscountequal = $_args['subdiscountequal'];
		if($subdiscountequal)
		{
			$subdiscountequal = \dash\number::clean($subdiscountequal);
			if($subdiscountequal && is_numeric($subdiscountequal))
			{
				$and['factors.subdiscount'] = [" = ", " '$subdiscountequal' "];
				self::$filter_args['subdiscount equal'] = $subdiscountequal;
				self::$is_filtered = true;
			}
		}

		$subtotal = $_args['subtotal'];
		if($subtotal)
		{
			$subtotal = \dash\number::clean($subtotal);
			if($subtotal && is_numeric($subtotal))
			{
				$and['factors.subtotal'] = [" = ", " '$subtotal' "];
				self::$filter_args['subdiscount equal'] = $subtotal;
				self::$is_filtered = true;
			}
		}



		$query_string = \dash\safe::forQueryString($_query_string);

		$query_string = mb_substr($query_string, 0, 50);

		if($query_string)
		{
			$or['factors.title']        = ["LIKE", "'%$query_string%'"];
			// $or['factors.slug']     = ["LIKE", "'$query_string%'"];

			$query_string_barcode = \dash\utility\convert::to_barcode($query_string);

			if($query_string_barcode)
			{
				$or['factors.id']  = ["=", "'$query_string'"];
			}


			self::$is_filtered = true;
		}


		if($_args['sort'] && !$order_sort)
		{

			if(in_array($_args['sort'], ['date', 'subprice', 'subtotal', 'subdiscount', 'item', 'qty','customer']))
			{
				$sort = mb_strtolower($_args['sort']);
				$order = null;
				if($_args['order'] && in_array($_args['order'], ['asc', 'desc']))
				{
					$order = mb_strtolower($_args['order']);
				}

				$order_sort = " ORDER BY $sort $order";

			}

		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY factors.id DESC ";
		}


		$and = array_merge($and, $_where);

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



	public static function list($_string, $_args)
	{
		$result = self::factors_list('detail', $_string, $_args);

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

}
?>
