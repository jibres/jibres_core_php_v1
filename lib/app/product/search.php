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
			'tag_id'       => null,
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

		if(isset($_args['limit']))
		{
			$meta['limit'] = $_args['limit'];
		}

		$order_sort  = null;


		if($_args['barcode'])
		{
			$barcode                 = \dash\number::clean($_args['barcode']);
			$and[] = " products.barcode  = '$barcode' ";
			self::$filter_args['barcode']  = '*'. T_('Barcode');
			self::$is_filtered       = true;
		}

		if($_args['price'])
		{
			$price = \dash\number::clean($_args['price']);
			if(is_numeric($price))
			{
				$and[] = " products.price = $price ";
				self::$filter_args['price']  = '*'. T_('Price');
			}
		}

		if($_args['buyprice'])
		{
			$buyprice = \dash\number::clean($_args['buyprice']);
			if(is_numeric($buyprice))
			{
				$and[] = " products.buyprice = $buyprice ";
				self::$filter_args['buyprice']  = '*'. T_('Buy price');
				self::$is_filtered        = true;
			}
		}


		if($_args['discount'])
		{
			$discount = \dash\number::clean($_args['discount']);
			if(is_numeric($discount))
			{
				$and[] = " products.discount = $discount ";
				self::$filter_args['discount']  = '*'. T_('Discount');
				self::$is_filtered        = true;
			}
		}

		if($_args['cat_id'] && is_numeric($_args['cat_id']))
		{
			$and[]   = " products.cat_id  $_args[cat_id] ";
			self::$filter_args['cat'] = '*'. T_('Category');
			self::$is_filtered        = true;
		}

		if($_args['tag_id'] && is_numeric($_args['tag_id']))
		{
			$and[]   = " producttagusage.producttag_id =  $_args[tag_id] ";
			$type = 'tagusage';
			self::$filter_args['tag'] = '*'. T_('Tag');
			self::$is_filtered        = true;
		}

		if($_args['unit_id'])
		{
			$unitid = $_args['unit_id'];
			if($unitid && is_numeric($unitid))
			{
				$and[] = "products.unit_id = $unitid ";
				self::$filter_args['unit'] = '*'. T_('Unit');
				self::$is_filtered = true;
			}
		}

		if($_args['company_id'] && is_numeric($_args['company_id']))
		{
			$and[] = " products.company_id = $_args[company_id] ";
			self::$filter_args['company']     = '*'. T_('Company');
			self::$is_filtered          = true;

		}

		// set filter

		if(isset($_args['filter']['duplicatetitle']) && $_args['filter']['duplicatetitle'])
		{
			$duplicate_id = \lib\db\products\get::duplicate_id();
			self::$filter_args['Duplicate title'] = null;
			self::$is_filtered              = true;

			if($duplicate_id)
			{
				$duplicate_id = implode(',', $duplicate_id);
				$and[]        = "products.id IN ($duplicate_id)";
				$order_sort   = 'ORDER BY products.title ASC';
			}
			else
			{
				$type = 'no-duplicatetitle';
			}

		}

		if(isset($_args['filter']['hbarcode']) && $_args['filter']['hbarcode'])
		{
			$or[] = "products.barcode IS NOT NULL";
			$or[] = "products.barcode2 IS NOT NULL";

			self::$filter_args['barcode']  = T_("Have barcode");
			self::$is_filtered       = true;
		}

		if(isset($_args['filter']['hnotbarcode']) && $_args['filter']['hnotbarcode'])
		{
			$and[] = "products.barcode IS NULL";
			$and[] = "products.barcode2 IS NULL";
			self::$filter_args['barcode']   = T_("Have not barcode");
			self::$is_filtered        = true;
		}

		if(isset($_args['filter']['wbuyprice']) && $_args['filter']['wbuyprice'])
		{
			$and[] = "(products.buyprice IS  NULL OR products.buyprice = 0 )";

			self::$filter_args['buyprice']      = T_("without buy price");

			$type                         = 'price';

			self::$is_filtered            = true;
		}

		if(isset($_args['filter']['wprice']) && $_args['filter']['wprice'])
		{
			$and[] = " (products.price  IS  NULL OR products.price = 0 )";
			self::$filter_args['price'] = T_("without price");

			$type                         = 'price';

			self::$is_filtered = true;
		}


		if(isset($_args['filter']['wdiscount']) && $_args['filter']['wdiscount'])
		{
			$and[] = "(products.discount IS NULL OR products.discount = 0 )";
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

		if(substr($query_string, 0, 1) === '+' && is_numeric(\dash\number::clean(substr($query_string, 1))))
		{
			$search         = substr($query_string, 1);
			$search         = \dash\number::clean($search);

			$and[] = "products.finalprice = ". \lib\price::up($search);
			$and[] = "products.barcode IS NULL";
			$and[] = "products.barcode2 IS NULL";
			$meta['pagination']                  = false;

			self::$filter_args['price'] = T_("without price");

			$type                         = 'price_factor_count';

			self::$is_filtered = true;
		}
		elseif($query_string)
		{
			$or[]        = " products.title LIKE '%$query_string%'";
			// $or['products.slug']     = ["LIKE", "'$query_string%'"];

			$query_string_barcode = \dash\utility\convert::to_barcode($query_string);

			if($query_string_barcode)
			{
				$or[] = " products.barcode = '$query_string'";
				$or[] = " products.barcode2 = '$query_string'";
			}

			$or[]      = "products.sku = '$query_string'";
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

		if(!$order_sort)
		{
			$order_sort = " ORDER BY products.id DESC";
		}
		$and[] = " products.status != 'deleted' ";

		$and = array_merge($and, $_where);

		switch ($type)
		{
			case 'price':
			case 'factor_admin_list':
				$list = \lib\db\products\search::list_join_price($and, $or, $order_sort, $meta);
				break;

			case 'price_factor_count':
				$list = \lib\db\products\search::list_join_price_factor_count($and, $or, $order_sort, $meta);
				break;

			case 'tagusage':
				$list = \lib\db\products\search::list_join_tag($and, $or, $order_sort, $meta);
				break;

			case 'no-duplicatetitle':
				// no result found by duplicate  title
				$list = [];
				break;

			default:
				$list = \lib\db\products\search::list($and, $or, $order_sort, $meta);
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
		$and = [];
		$and[] = "products.parent IS NULL ";

		$list = self::products_list('variants', $_query_string, $_args, $and);

		$list = self::fill_category($list);

		foreach ($list as $key => $value)
		{
			$list[$key]['variants_detail'] = [];
			$list[$key]['price_string']    = \dash\utility\human::fitNumber($value['finalprice']);
		}

		$product_ids = array_column($list, 'id');
		$product_ids = array_map('intval', $product_ids);

		$product_ids = array_filter($product_ids);

		$product_ids = array_unique($product_ids);

		if($product_ids)
		{
			$load_child = \lib\db\products\get::variants_load_child_count(implode(',', $product_ids));

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

						$min_price = \lib\price::down($variants[$value['id']]['min_price']);
						$max_price = \lib\price::down($variants[$value['id']]['max_price']);
						if($min_price !== $max_price)
						{
							$min_price = \dash\utility\human::fitNumber($min_price);
							$max_price = \dash\utility\human::fitNumber($max_price);

							$list[$key]['price_string'] = $min_price . ' ... '. $max_price;
						}
					}
				}
			}
		}

		return $list;
	}




	public static function list_in_sale($_query_string, $_args)
	{
		$_args['limit'] = 25;
		$list        = self::products_list('price_factor_count', $_query_string, $_args);
		return $list;
	}

	public static function price_list($_query_string, $_args)
	{
		$list        = self::products_list('price', $_query_string, $_args);
		return $list;
	}


	public static function factor_admin_list($_query_string, $_args)
	{
		$and = [];
		$and[] = "products.variant_child IS  NULL ";

		$list        = self::products_list('factor_admin_list', $_query_string, $_args, $and);
		return $list;
	}


	private static function fill_category($_list)
	{
		if(!$_list || !is_array($_list))
		{
			return $_list;
		}

		$cat_id = array_column($_list, 'cat_id');
		$cat_id = array_filter($cat_id);
		$cat_id = array_unique($cat_id);
		if(!$cat_id)
		{
			return $_list;
		}

		$cat_detail = \lib\db\productcategory\get::by_muliti_id(implode(',', $cat_id));
		if(is_array($cat_detail))
		{
			$cat_detail = array_combine(array_column($cat_detail, 'id'), $cat_detail);
			foreach ($_list as $key => $value)
			{
				if(isset($value['cat_id']) && isset($cat_detail[$value['cat_id']]['title']))
				{
					$_list[$key]['category'] = $cat_detail[$value['cat_id']]['title'];
				}
			}
		}

		return $_list;

	}



}
?>