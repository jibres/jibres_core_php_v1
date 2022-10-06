<?php
namespace lib\app\order;

class search
{
	private static $is_filtered    = false;


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args)
	{
		if(isset($_args['my_orders']) && $_args['my_orders'])
		{
			/* only load my orders needless to check permission*/
		}
		else
		{
			\dash\permission::access('_group_orders');
		}

		$condition =
		[
			'my_orders'         => 'bit',
			'order'             => 'order',
			'sort'              => filter::sort_enum(),

			'customer'          => 'string',
			'user'          => 'string',
			'type'              => ['enum' => ['sale', 'buy', 'saleorder']],
			'product'           => 'id',
			'guestid'           => 'md5',

			'startdate'         => 'date',
			'enddate'           => 'date',
			'date'              => 'date',
			'time'              => 'time',
			'weekday'           => 'weekday',
			'pay'               => 'y_n',

			'discount_id'       => 'id',
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
			'limit'             => 'int',
			'get_unprocessed'   => 'bit',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and   = [];
		$param = [];
		$meta  = [];
		$or    = [];

		$join_factordetails = false;

		$order_sort         = null;

		if($data['limit'])
		{
			$meta['limit'] = $data['limit'];
		}

		// convert customer to user search for save old link ?customer=11
		if($data['user'])
		{
			$data['customer'] = $data['user'];
		}



		$and[] = " factors.status != 'deleted' ";

		if($data['get_unprocessed'])
		{
			$and[] = " factors.status IN ('registered', 'awaiting', 'confirmed', 'preparing', 'sending') AND factors.paystatus != 'awaiting_payment' ";
		}


		if($data['customer'])
		{
			if($data['customer'] === '-quick')
			{
				$and[] = ' factors.customer IS NULL ';
			}
			else
			{
				$id = \dash\validate::code($data['customer']);
				$id = \dash\coding::decode($id);
				if($id)
				{
					$and[] = " factors.customer = :factors_customer_id ";

					$param[':factors_customer_id'] = $id;

					self::$is_filtered             = true;
				}
			}


		}

		if($data['type'])
		{
			$and[] = " factors.type = :factor_type ";
			$param[':factor_type'] = $data['type'];

			self::$is_filtered             = true;
		}

		if($data['discount_id'])
		{
			$and[] = " factors.discount_id = :factor_discount ";
			$param[':factor_discount'] = $data['discount_id'];
			self::$is_filtered             = true;
		}


		if($data['guestid'])
		{
			$and[] = " factors.guestid = :factor_guestid ";
			$param[':factor_guestid'] = $data['guestid'];
			self::$is_filtered             = true;
		}

		if($data['product'])
		{
			$join_factordetails               = true;
			$and[] = " factordetails.product_id = :factordetails_product_id ";
			$param[':factordetails_product_id'] = $data['product'];
			self::$is_filtered                = true;
		}

		if($data['startdate'] && $data['enddate'])
		{
			$and[] = " DATE(factors.datecreated) >=  :factor_datecreated_larger ";
			$param[':factor_datecreated_larger'] = $data['startdate'];

			$and[] = " DATE(factors.datecreated) <=  :factor_datecreated_less ";
			$param[':factor_datecreated_less'] = $data['enddate'];

			self::$is_filtered          = true;
		}
		elseif($data['startdate'])
		{
			$and[] = " DATE(factors.datecreated) >=  :factor_datecreated_equal_larger ";
			$param[':factor_datecreated_equal_larger'] = $data['startdate'];
			self::$is_filtered          = true;
		}
		elseif($data['enddate'])
		{
			$and[] = " DATE(factors.datecreated) <=  :factor_datecreated_equal_less ";
			$param[':factor_datecreated_equal_less'] = $data['enddate'];
			self::$is_filtered          = true;
		}


		if($data['date'])
		{
			$and[] = " DATE(factors.datecreated) =  :factor_datecreated_is_equal ";
			$param[':factor_datecreated_is_equal'] = $data['date'];
			self::$is_filtered = true;
		}

		if($data['time'])
		{
			$time  = $data['time'];
			$and[] =  " HOUR(factors.datecreated) =  HOUR(:factor_hour) ";
			$and[] =  " MINUTE(factors.datecreated) =  MINUTE(:factor_min) ";
			$param[':factor_hour'] = $time;
			$param[':factor_min'] = $time;

			self::$is_filtered = true;
		}

		if($data['weekday'])
		{
			$and[] = " DAYNAME(factors.datecreated) = :factor_datecreated_dayname " ;
			$param[':factor_datecreated_dayname'] = $data['weekday'];
			self::$is_filtered = true;
		}

		if($data['subpricelarger'])
		{
			$and[] = " factors.subprice > :factor_subprice_larger ";
			$param[':factor_subprice_larger'] = floatval($data['subpricelarger']);
			self::$is_filtered = true;
		}

		if($data['subpriceless'])
		{
			$and[] = " factors.subprice <  :factor_subpriceless ";
			$param[':factor_subpriceless'] = floatval($data['subpriceless']);
			self::$is_filtered = true;
		}

		if($data['subpriceequal'])
		{
			$and[] = " factors.subprice =  :factor_subpriceequal ";
			$param[':factor_subpriceequal'] = floatval($data['subpriceequal']);
			self::$is_filtered = true;
		}


		if($data['itemlarger'])
		{
			$and[] = " factors.item > :factor_itemlarger ";
			$param[':factor_itemlarger'] = floatval($data['itemlarger']);
			self::$is_filtered = true;
		}

		if($data['itemless'])
		{
			$and[] = " factors.item <  :factor_itemless ";
			$param[':factor_itemless'] = floatval($data['itemless']);
			self::$is_filtered = true;
		}

		if($data['itemequal'])
		{
			$and[] = " factors.item =  :factor_itemequal ";
			$param[':factor_itemequal'] = floatval($data['itemequal']);
			self::$is_filtered = true;
		}

		if($data['qtylarger'])
		{
			$and[] = " factors.qty > :factor_qtylarger ";
			$param[':factor_qtylarger'] = floatval($data['qtylarger']);
			self::$is_filtered = true;
		}

		if($data['qtyless'])
		{
			$and[] = " factors.qty <  :factor_qtyless ";
			$param[':factor_qtyless'] = floatval($data['qtyless']);
			self::$is_filtered = true;
		}

		if($data['qtyequal'])
		{
			$and[] = " factors.qty =  :factor_qtyequal ";
			$param[':factor_qtyequal'] = floatval($data['qtyequal']);
			self::$is_filtered = true;
		}

		if($data['subtotallarger'])
		{
			$and[] = " factors.subtotal > :factor_subtotallarger ";
			$param[':factor_subtotallarger'] = floatval($data['subtotallarger']);
			self::$is_filtered = true;
		}

		if($data['subtotalless'])
		{
			$and[] = " factors.subtotal <  :factor_subtotalless ";
			$param[':factor_subtotalless'] = floatval($data['subtotalless']);
			self::$is_filtered = true;
		}

		if($data['subtotalequal'])
		{
			$and[] = " factors.subtotal =  :factor_subtotalequal ";
			$param[':factor_subtotalequal'] = floatval($data['subtotalequal']);
			self::$is_filtered = true;
		}

		if($data['subtotal'])
		{
			$and[] = " factors.subtotal =  :factor_is_subtotal ";
			$param[':factor_is_subtotal'] = floatval($data['subtotal']);
			self::$is_filtered = true;
		}

		if($data['subdiscountlarger'])
		{
			$and[] = " factors.subdiscount > :factor_subdiscountlarger ";
			$param[':factor_subdiscountlarger'] = floatval($data['subdiscountlarger']);
			self::$is_filtered = true;
		}

		if($data['subdiscountless'])
		{
			$and[] = " factors.subdiscount <  :factor_subdiscountless ";
			$param[':factor_subdiscountless'] = floatval($data['subdiscountless']);
			self::$is_filtered = true;
		}

		if($data['subdiscountequal'])
		{
			$and[] = " factors.subdiscount =  :factor_subdiscountequal ";
			$param[':factor_subdiscountequal'] = floatval($data['subdiscountequal']);
			self::$is_filtered = true;
		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " factors.title LIKE :factors_query_search_string ";
			$param[':factors_query_search_string'] = '%'. $query_string. '%';


			$query_string_barcode = \dash\validate::barcode($query_string, false);

			if($query_string_barcode)
			{
				$or[] = " factors.id = :factors_query_string_id ";
				$param[':factors_query_string_id'] = floatval($query_string_barcode);
			}

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			$order_sort      = " ORDER BY $data[sort] $data[order] ";
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY factors.id DESC ";
		}


		if($join_factordetails)
		{
			$list = \lib\db\orders\search::list_join_by_factordetails($param, $and, $or, $order_sort, $meta);
		}
		else
		{
			$list = \lib\db\orders\search::list($param, $and, $or, $order_sort, $meta);
		}


		if(!is_array($list))
		{
			$list = [];
		}


		/*========================================================
		=            Load product detail of this list            =
		========================================================*/
		$factors_id = array_column($list, 'id');
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
						$list = self::merge_detail($list, $factor_detail, $product_detail);
					}
				}

			}
		}
		/*=====  End of Load product detail of this list  ======*/


		$list = array_map(['\\lib\\app\\factor\\ready', 'row'], $list);
		$list = array_map(['\\dash\\app', 'fix_avatar'], $list);


		return $list;
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

			$temp['count'] = floatval($value['count']);
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
		return floatval(floatval($_data));
	}

	private static function price_sum_down($_data)
	{
		return floatval(floatval($_data));
	}

	public static function last_user_order($_user_id)
	{
		$args              = [];
		$args['customer']  = \dash\coding::encode($_user_id);
		$args['limit']     = 5;
		$args['my_orders'] = true;

		return self::factors_list('detail', null, $args);
	}


	public static function my_orders()
	{
		if(!\dash\user::id())
		{
			if(!\dash\user::get_user_guest())
			{
				return null;
			}
		}

		if(\dash\user::id())
		{
			$result = self::list(null, ['my_orders' => true, 'customer' => \dash\user::code()]);
		}
		else
		{
			$result = self::list(null, ['my_orders' => true, 'guestid' => \dash\user::get_user_guest()]);

		}

		return $result;

	}

}
?>
