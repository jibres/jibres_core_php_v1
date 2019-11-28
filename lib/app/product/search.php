<?php
namespace lib\app\product;

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

		$_args       = array_merge($default_args, $_args);
		$type        = $_type;
		$and         = [];
		$meta        = [];
		$or          = [];

		$order_sort  = null;


		if($_args['barcode'])
		{
			$barcode                 = \dash\utility\convert::to_en_number($_args['barcode']);
			$and['products.barcode'] = $barcode;
			self::$filter_args['barcode']  = '*'. T_('Barcode');
			self::$is_filtered       = true;
		}

		if($_args['price'])
		{
			$price = \dash\utility\convert::to_en_number($_args['price']);
			if(is_numeric($price))
			{
				$and['products.price'] = $price;
				self::$filter_args['price']  = '*'. T_('Price');
			}
		}

		if($_args['buyprice'])
		{
			$buyprice = \dash\utility\convert::to_en_number($_args['buyprice']);
			if(is_numeric($buyprice))
			{
				$and['products.buyprice'] = $buyprice;
				self::$filter_args['buyprice']  = '*'. T_('Buy price');
				self::$is_filtered        = true;
			}
		}

		if($_args['cat'])
		{
			$and['products.cat'] = $_args['cat'];
			self::$filter_args['cat']  = '*'. T_('Category');
		}

		if($_args['discount'])
		{
			$discount = \dash\utility\convert::to_en_number($_args['discount']);
			if(is_numeric($discount))
			{
				$and['products.discount'] = $discount;
				self::$filter_args['discount']  = '*'. T_('Discount');
				self::$is_filtered        = true;
			}
		}

		if($_args['cat_id'])
		{
			$and['products.cat_id']   = $_args['cat_id'];
			self::$filter_args['cat'] = '*'. T_('Category');
			self::$is_filtered        = true;
		}

		if($_args['unit_id'])
		{
			$unitid = \dash\coding::decode($_args['unit_id']);
			if($unitid)
			{
				$and['products.unit_id'] = $unitid;
				self::$filter_args['unit'] = '*'. T_('Unit');
				self::$is_filtered = true;
			}
		}

		if($_args['company_id'])
		{
			$companyid = \dash\coding::decode($_args['company_id']);
			if($companyid)
			{
				$and['products.company_id'] = $companyid;
				self::$filter_args['company']     = '*'. T_('Company');
				self::$is_filtered          = true;
			}
		}

		// set filter

		if(isset($_args['filter']['duplicatetitle']) && $_args['filter']['duplicatetitle'])
		{
			$duplicate_id = \lib\db\products\db::get_duplicate_id();
			self::$filter_args['Duplicate title'] = null;
			self::$is_filtered              = true;

			if($duplicate_id)
			{
				$duplicate_id                   = implode(',', $duplicate_id);
				$and['products.id']             = ["IN", "($duplicate_id)"];
				$order_sort                     = 'ORDER BY products.title ASC';
			}
			else
			{
				$type = 'no-duplicatetitle';
			}

		}

		if(isset($_args['filter']['hbarcode']) && $_args['filter']['hbarcode'])
		{
			$or['products.barcode']  = [" IS ", " NOT NULL "];
			$or['products.barcode2'] = [" IS ", " NOT NULL "];
			self::$filter_args['barcode']  = T_("Have barcode");
			self::$is_filtered       = true;
		}

		if(isset($_args['filter']['hnotbarcode']) && $_args['filter']['hnotbarcode'])
		{
			$and['products.barcode']  = [" IS ", " NULL "];
			$and['products.barcode2'] = [" IS ", " NULL "];
			self::$filter_args['barcode']   = T_("Have not barcode");
			self::$is_filtered        = true;
		}

		if(isset($_args['filter']['wbuyprice']) && $_args['filter']['wbuyprice'])
		{
			$and['productprices.buyprice'] = [' IS ', ' NULL '];
			self::$filter_args['buyprice']      = T_("without buy price");

			$type                         = 'price';

			self::$is_filtered            = true;
		}

		if(isset($_args['filter']['wprice']) && $_args['filter']['wprice'])
		{
			$and['productprices.price'] = [' IS ', ' NULL '];
			self::$filter_args['price'] = T_("without price");

			$type                         = 'price';

			self::$is_filtered = true;
		}


		if(isset($_args['filter']['wdiscount']) && $_args['filter']['wdiscount'])
		{
			$and['productprices.discount'] = [' IS ', ' NULL '];
			self::$filter_args['discount']       = T_("without discount");

			$type                          = 'price';

			self::$is_filtered             = true;
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


		if($_args['sort'] && !$order_sort)
		{

			$check_order_trust = \lib\app\product\filter::check_allow($_args['sort'], $_args['order'], $type);

			if($check_order_trust)
			{
				$sort = mb_strtolower($_args['sort']);
				$order = null;
				if($_args['order'])
				{
					$order = mb_strtolower($_args['order']);
				}

				$order_sort = " ORDER BY $sort $order";
			}
		}


		$and = array_merge($and, $_where);

		switch ($type)
		{
			case 'price':
				$list = \lib\db\products\datalist::list_join_price($and, $or, $order_sort, $meta);
				break;

			case 'no-duplicatetitle':
				// no result found by duplicate  title
				$list = [];
				break;

			default:
				$list = \lib\db\products\datalist::list($and, $or, $order_sort, $meta);
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