<?php
namespace lib\app\product;

class search
{
	private static $filter_message = null;
	private static $is_filtered    = false;


	public static function filter_message()
	{
		return self::$filter_message;
	}


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	private static function products_list($_type, $_query_string, $_args, $_where = [])
	{
		$default_args =
		[
			'order'        => null,
			'sort'         => null,
			'barcode'      => null,
			'price'        => null,
			'buyprice'     => null,
			'cat'          => null,
			'cat_id'       => null,
			'discount'     => null,
			'unit_id'      => null,
			'company_id'   => null,
			'guarantee_id' => null,
			'filter'       => [],
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		if(!is_array($_where))
		{
			$_where = [];
		}

		$_args = array_merge($default_args, $_args);

		$and         = [];
		$or          = [];
		$filter_args = [];
		$order_sort  = null;

		if($_args['barcode'])
		{
			$barcode = \dash\utility\convert::to_en_number($_args['barcode']);
			$and['products.barcode'] = $barcode;
			$filter_args['barcode'] = T_('Barcode');
			self::$is_filtered = true;
		}

		// if($_args['price'])
		// {
		// 	$price = \dash\utility\convert::to_en_number($_args['price']);
		// 	if(is_numeric($price))
		// 	{
		// 		$and['products.price'] = $price;
		// 		$filter_args['price'] = T_('Price');
		// 	}
		// }

		if($_args['buyprice'])
		{
			$buyprice = \dash\utility\convert::to_en_number($_args['buyprice']);
			if(is_numeric($buyprice))
			{
				$and['products.buyprice'] = $buyprice;
				$filter_args['buyprice'] = T_('Buy price');
				self::$is_filtered = true;
			}
		}

		if($_args['cat'])
		{
			$and['products.cat'] = $_args['cat'];
			$filter_args['cat']  = T_('Category');
		}

		if($_args['discount'])
		{
			$discount = \dash\utility\convert::to_en_number($_args['discount']);
			if(is_numeric($discount))
			{
				$and['products.discount'] = $discount;
				$filter_args['discount'] = T_('Discount');
				self::$is_filtered = true;
			}
		}

		if($_args['cat_id'])
		{
			$catid = \dash\coding::decode($_args['cat_id']);
			if($catid)
			{
				$and['products.cat_id'] = $catid;
				$filter_args['cat'] = T_('Category');
				self::$is_filtered = true;
			}
		}

		if($_args['unit_id'])
		{
			$unitid = \dash\coding::decode($_args['unit_id']);
			if($unitid)
			{
				$and['products.unit_id'] = $unitid;
				$filter_args['unit'] = T_('Unit');
				self::$is_filtered = true;
			}
		}

		if($_args['company_id'])
		{
			$companyid = \dash\coding::decode($_args['company_id']);
			if($companyid)
			{
				$and['products.company_id'] = $companyid;
				$filter_args['company'] = T_('Company');
				self::$is_filtered = true;
			}
		}

		if($_args['guarantee_id'])
		{
			$guaranteeid = \dash\coding::decode($_args['guarantee_id']);
			if($guaranteeid)
			{
				$and['products.guarantee_id'] = $guaranteeid;
				$filter_args['guarantee'] = T_('Guarantee');
				self::$is_filtered = true;
			}
		}
		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\safe::forQueryString($_query_string);

		$query_string = mb_substr($query_string, 0, 50);

		if($query_string)
		{
			$or['products.title']    = ["LIKE", "'$query_string%'"];
			$or['products.slug']     = ["LIKE", "'$query_string%'"];

			$or['products.barcode']  = ["=", "'$query_string'"];
			$or['products.barcode2'] = ["=", "'$query_string'"];

			$or['products.sku']      = ["=", "'$query_string'"];
			self::$is_filtered = true;
		}

		$and = array_merge($and, $_where);

		switch ($_type)
		{
			case 'price':
				$list = \lib\db\products\datalist::all_list($and, $or, $order_sort);
				break;

			default:
				$list = \lib\db\products\datalist::list($and, $or, $order_sort);
				break;
		}

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\product\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		$filter_args_data = [];

		foreach ($filter_args as $key => $value)
		{
			if(isset($list[0][$key]))
			{
				$filter_args_data[$value] = $list[0][$key];
			}
		}

		self::$filter_message = \dash\app\sort::createFilterMsg($query_string, $filter_args_data);

		return $list;
	}


	public static function variant_list($_query_string, $_args)
	{
		$where['parent'] = [' IS ', ' NULL '];

		$list        = self::products_list('variants', $_query_string, $_args, $where);

		foreach ($list as $key => $value)
		{
			$list[$key]['variants_detail'] = [];
		}

		$product_ids = array_column($list, 'id');
		$product_ids = array_map('intval', $product_ids);

		$product_ids = array_filter($product_ids);

		$product_ids = array_unique($product_ids);

		if($product_ids)
		{
			$load_child = \lib\db\products\variants::load_child_count(implode(',', $product_ids));

			if($load_child && is_array($load_child))
			{
				$variants = [];
				foreach ($load_child as $key => $value)
				{
					$temp = $value;
					unset($temp['parent']);
					$variants[$value['parent']] = $temp;
				}

				foreach ($list as $key => $value)
				{
					if(isset($variants[$value['id']]))
					{
						$list[$key]['variants_detail'] = $variants[$value['id']];
					}
				}
			}
		}

		return $list;
	}


	public static function price_list($_query_string, $_args)
	{
		$list        = self::products_list('price', $_query_string, $_args);
		return $list;
	}
}
?>