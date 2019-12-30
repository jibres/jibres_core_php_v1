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
			'detailsumlarger'      => null,
			'detailsumless'        => null,
			'detailsumequal'       => null,
			'itemlarger'           => null,
			'itemless'             => null,
			'itemequal'            => null,
			'qtylarger'            => null,
			'qtyless'              => null,
			'qtyequal'             => null,
			'detailtotalsumlarger' => null,
			'detailtotalsumless'   => null,
			'detailtotalsumequal'  => null,
			'detaildiscountlarger' => null,
			'detaildiscountless'   => null,
			'detaildiscountequal'  => null,
			'detailtotalsum'       => null,


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
			self::$filter_args['customer'] = '*'. T_('Cusomer');
			self::$is_filtered             = true;
		}


		if($_args['type'] && is_string($_args['type']))
		{
			$and['factors.type']       = $_args['type'];
			self::$filter_args['type'] = '*'. T_('Cusomer');
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
			self::$filter_args['customer']    = '*'. T_('Cusomer');
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

		$detailsumlarger = $_args['detailsumlarger'];
		if($detailsumlarger)
		{
			$detailsumlarger = \dash\number::clean($detailsumlarger);
			if($detailsumlarger && is_numeric($detailsumlarger))
			{
				$and['factors.detailsum'] = [" > ", " $detailsumlarger "];
				self::$filter_args['detailsum larger than'] = $detailsumlarger;
				self::$is_filtered = true;
			}
		}

		$detailsumless = $_args['detailsumless'];
		if($detailsumless)
		{
			$detailsumless = \dash\number::clean($detailsumless);
			if($detailsumless && is_numeric($detailsumless))
			{
				$and['factors.detailsum'] = [" < ", " '$detailsumless' "];
				self::$filter_args['detailsum less than'] = $detailsumless;
				self::$is_filtered = true;
			}
		}

		$detailsumequal = $_args['detailsumequal'];
		if($detailsumequal)
		{
			$detailsumequal = \dash\number::clean($detailsumequal);
			if($detailsumequal && is_numeric($detailsumequal))
			{
				$and['factors.detailsum'] = [" = ", " '$detailsumequal' "];
				self::$filter_args['detailsum equal'] = $detailsumequal;
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

		$detailtotalsumlarger = $_args['detailtotalsumlarger'];
		if($detailtotalsumlarger)
		{
			$detailtotalsumlarger = \dash\number::clean($detailtotalsumlarger);
			if($detailtotalsumlarger && is_numeric($detailtotalsumlarger))
			{
				$and['factors.detailtotalsum'] = [" > ", " '$detailtotalsumlarger' "];
				self::$filter_args['detailtotalsum larger than'] = $detailtotalsumlarger;
				self::$is_filtered = true;
			}
		}

		$detailtotalsumless = $_args['detailtotalsumless'];
		if($detailtotalsumless)
		{
			$detailtotalsumless = \dash\number::clean($detailtotalsumless);
			if($detailtotalsumless && is_numeric($detailtotalsumless))
			{
				$and['factors.detailtotalsum'] = [" < ", " '$detailtotalsumless' "];
				self::$filter_args['detailtotalsum less than'] = $detailtotalsumless;
				self::$is_filtered = true;
			}
		}

		$detailtotalsumequal = $_args['detailtotalsumequal'];
		if($detailtotalsumequal)
		{
			$detailtotalsumequal = \dash\number::clean($detailtotalsumequal);
			if($detailtotalsumequal && is_numeric($detailtotalsumequal))
			{
				$and['factors.detailtotalsum'] = [" = ", " '$detailtotalsumequal' "];
				self::$filter_args['detailtotalsum equal'] = $detailtotalsumequal;
				self::$is_filtered = true;
			}
		}


		$detaildiscountlarger = $_args['detaildiscountlarger'];
		if($detaildiscountlarger)
		{
			$detaildiscountlarger = \dash\number::clean($detaildiscountlarger);
			if($detaildiscountlarger && is_numeric($detaildiscountlarger))
			{
				$and['factors.detaildiscount'] = [" > ", " '$detaildiscountlarger' "];
				self::$filter_args['detaildiscount larger than'] = $detaildiscountlarger;
				self::$is_filtered = true;
			}
		}

		$detaildiscountless = $_args['detaildiscountless'];
		if($detaildiscountless)
		{
			$detaildiscountless = \dash\number::clean($detaildiscountless);
			if($detaildiscountless && is_numeric($detaildiscountless))
			{
				$and['factors.detaildiscount'] = [" < ", " '$detaildiscountless' "];
				self::$filter_args['detaildiscount less than'] = $detaildiscountless;
				self::$is_filtered = true;
			}
		}

		$detaildiscountequal = $_args['detaildiscountequal'];
		if($detaildiscountequal)
		{
			$detaildiscountequal = \dash\number::clean($detaildiscountequal);
			if($detaildiscountequal && is_numeric($detaildiscountequal))
			{
				$and['factors.detaildiscount'] = [" = ", " '$detaildiscountequal' "];
				self::$filter_args['detaildiscount equal'] = $detaildiscountequal;
				self::$is_filtered = true;
			}
		}

		$detailtotalsum = $_args['detailtotalsum'];
		if($detailtotalsum)
		{
			$detailtotalsum = \dash\number::clean($detailtotalsum);
			if($detailtotalsum && is_numeric($detailtotalsum))
			{
				$and['factors.detailtotalsum'] = [" = ", " '$detailtotalsum' "];
				self::$filter_args['detaildiscount equal'] = $detailtotalsum;
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

			$or['factors.sku']      = ["=", "'$query_string'"];
			self::$is_filtered = true;
		}


		if($_args['sort'] && !$order_sort)
		{

			if(in_array($_args['sort'], ['date', 'detailsum', 'detailtotalsum', 'detaildiscount', 'item', 'qty','customer']))
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
