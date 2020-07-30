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



		$condition =
		[
			'order'             => 'order',
			'sort'              => ['enum' => ['title','price','buyprice']],
			'limit'             => 'int',
			'barcode'           => 'barcode',
			'price'             => 'price',
			'buyprice'          => 'price',
			'discount'          => 'price',
			'cat_id'            => 'id',
			'tag_id'            => 'id',
			'unit_id'           => 'id',
			'company_id'        => 'id',
			'duplicatetitle'    => 'bit',
			'hbarcode'          => 'bit',
			'hnotbarcode'       => 'bit',
			'wbuyprice'         => 'bit',
			'wprice'            => 'bit',
			'wdiscount'         => 'bit',
			'instock'           => 'bit',
			'outofstock'        => 'bit',
			'negativeinventory' => 'bit',
			'notsold'           => 'bit',
			'notweight'         => 'bit',

			'withoutimage'      => 'bit',
			'havevariants'      => 'bit',

			'websitemode'       => 'bit',

		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if(!is_array($_where))
		{
			$_where = [];
		}

		$type = $_type;
		$and  = [];
		$meta = [];
		$or   = [];
		$join = [];

		if(isset($data['limit']))
		{
			$meta['limit'] = $data['limit'];
		}

		$order_sort  = null;


		if($data['barcode'])
		{
			$and[] = " products.barcode  = '$data[barcode]' ";
			self::$filter_args['barcode']  = '*'. T_('Barcode');
			self::$is_filtered       = true;
		}

		if($data['price'])
		{
			$and[] = " products.price = $data[price] ";
			self::$filter_args['price']  = '*'. T_('Price');
		}

		if($data['buyprice'])
		{
			$and[] = " products.buyprice = $data[buyprice] ";
			self::$filter_args['buyprice']  = '*'. T_('Buy price');
			self::$is_filtered        = true;
		}


		if($data['discount'])
		{
			$and[] = " products.discount = $data[discount] ";
			self::$filter_args['discount']  = '*'. T_('Discount');
			self::$is_filtered        = true;
		}

		if($data['cat_id'])
		{

			$and[]   = " productcategoryusage.productcategory_id =  $data[cat_id] ";
			$join[] = ' INNER JOIN productcategoryusage ON productcategoryusage.product_id = products.id ';
			$type = 'catusage';
			self::$filter_args['cat'] = '*'. T_('Category');
			self::$is_filtered        = true;
		}

		if($data['tag_id'])
		{
			$and[]   = " producttagusage.producttag_id =  $data[tag_id] ";
			$join[] = ' INNER JOIN producttagusage ON producttagusage.product_id = products.id ';
			self::$filter_args['tag'] = '*'. T_('Tag');
			self::$is_filtered        = true;
		}

		if($data['unit_id'])
		{
			$and[] = "products.unit_id = $data[unit_id] ";
			self::$filter_args['unit'] = '*'. T_('Unit');
			self::$is_filtered = true;
		}

		if($data['company_id'])
		{
			$and[] = " products.company_id = $data[company_id] ";
			self::$filter_args['company']     = '*'. T_('Company');
			self::$is_filtered          = true;

		}

		// set filter

		if(isset($data['duplicatetitle']) && $data['duplicatetitle'])
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

		if(isset($data['instock']) && $data['instock'])
		{
			$and[] = "products.instock  = 1";
			self::$filter_args['Stock']   = T_("Instock");
			self::$is_filtered        = true;
		}

		if(isset($data['outofstock']) && $data['outofstock'])
		{
			$and[] = "( products.instock  = 0 OR products.instock  IS NULL )";
			self::$filter_args['Stock']   = T_("Out of stock");
			self::$is_filtered        = true;
		}

		if(isset($data['negativeinventory']) && $data['negativeinventory'])
		{
			$and[] = " (SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) < 0 ";
			self::$filter_args['Stock']   = T_("Negative");
			self::$is_filtered        = true;
		}


		if(isset($data['notsold']) && $data['notsold'])
		{
			$and[] = " (SELECT factordetails.product_id FROM factordetails WHERE factordetails.product_id = products.id AND factordetails.status = 'enable' LIMIT 1) IS NULL ";
			self::$filter_args['']   = T_("Not sold");
			self::$is_filtered        = true;
		}


		if(isset($data['withoutimage']) && $data['withoutimage'])
		{
			$and[] = "products.thumb IS NULL";
			self::$filter_args['Image']   = T_("Without image");
			self::$is_filtered        = true;
		}

		if(isset($data['havevariants']) && $data['havevariants'])
		{
			$and[] = " products.variant_child  = 1 ";
			self::$filter_args['Variants']   = T_("Have variants");
			self::$is_filtered        = true;
		}




		if(isset($data['hbarcode']) && $data['hbarcode'])
		{
			$or[] = "products.barcode IS NOT NULL";
			$or[] = "products.barcode2 IS NOT NULL";

			self::$filter_args['barcode']  = T_("Have barcode");
			self::$is_filtered       = true;
		}

		if(isset($data['hnotbarcode']) && $data['hnotbarcode'])
		{
			$and[] = "products.barcode IS NULL";
			$and[] = "products.barcode2 IS NULL";
			self::$filter_args['barcode']   = T_("Have not barcode");
			self::$is_filtered        = true;
		}

		if(isset($data['wbuyprice']) && $data['wbuyprice'])
		{
			$and[] = "(products.buyprice IS  NULL OR products.buyprice = 0 )";

			self::$filter_args['buyprice']      = T_("without buy price");

			$type                         = 'price';

			self::$is_filtered            = true;
		}

		if(isset($data['wprice']) && $data['wprice'])
		{
			$and[] = " (products.price  IS  NULL OR products.price = 0 )";
			self::$filter_args['price'] = T_("without price");

			$type                         = 'price';

			self::$is_filtered = true;
		}


		if(isset($data['wdiscount']) && $data['wdiscount'])
		{
			$and[] = "(products.discount IS NULL OR products.discount = 0 )";
			self::$filter_args['discount']       = T_("without discount");

			$type                          = 'price';

			self::$is_filtered             = true;
		}

		if(isset($data['notweight']) && $data['notweight'])
		{
			$and[] = "(products.weight IS NULL OR products.weight = 0 )";
			self::$filter_args['weightt']       = T_("without weight");

			$type                          = 'price';

			self::$is_filtered             = true;
		}





		if($data['websitemode'])
		{
			$and[] = " products.status != 'deleted'";
			// $and[] = " products.instock = 'yes'";
			$and[] = " products.parent IS NULL ";
		}



		$query_string = \dash\validate::search($_query_string);

		if(substr($query_string, 0, 1) === '+' && is_numeric(\dash\number::clean(substr($query_string, 1))))
		{
			$search         = substr($query_string, 1);
			$search         = \dash\number::clean($search);

			$and[] = " ( products.finalprice = ". \lib\price::up($search). " OR products.price = ". \lib\price::up($search). " )";

			$and[] = "products.barcode IS NULL";
			$and[] = "products.barcode2 IS NULL";
			$meta['pagination']                  = false;

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

			if(is_numeric($query_string) || is_numeric(\dash\utility\convert::to_en_number($query_string)))
			{
				$search_price = \dash\utility\convert::to_en_number($query_string);

				$or[] = "products.finalprice = ". \lib\price::up($search_price);
				$or[] = "products.price = ". \lib\price::up($search_price);
			}

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{

			$check_order_trust = \lib\app\product\filter::check_allow($data['sort'], $data['order'], $type);

			if($check_order_trust)
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
			$order_sort = " ORDER BY products.id DESC";
		}
		$and[] = " products.status != 'deleted' ";

		$and = array_merge($and, $_where);

		$meta['join'] = $join;

		switch ($type)
		{
			case 'price_factor_count':
				$list = \lib\db\products\search::list_join_price_factor_count($and, $or, $order_sort, $meta);
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
		$and   = [];
		$and[] = "products.parent IS NULL ";

		$list = self::products_list('variants', $_query_string, $_args, $and);

		self::load_variants($list);


		return $list;
	}



	public static function website_product_search($_query_string, $_args)
	{
		$and   = [];
		$and[] = "products.parent IS NULL ";

		$list = self::products_list('variants', $_query_string, $_args, $and);

		self::detect_min_variant_price($list);


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
		$and   = [];
		$and[] = " products.variant_child IS  NULL ";

		$list        = self::products_list('factor_admin_list', $_query_string, $_args, $and);
		return $list;
	}


	private static function load_variants(&$list)
	{
		foreach ($list as $key => $value)
		{
			$list[$key]['variants_detail'] = [];
			if(isset($value['finalprice']))
			{
				$list[$key]['variant_price']    = \dash\fit::number($value['finalprice']);
			}
			else
			{
				$list[$key]['variant_price']    = '';
			}
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
							$min_price = \dash\fit::number($min_price);
							$max_price = \dash\fit::number($max_price);

							$list[$key]['variant_price'] = $min_price . ' ... '. $max_price;
						}
					}
				}
			}
		}
	}


	public static function detect_min_variant_price(&$list)
	{
		$have_variant = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['variant_child']) && $value['variant_child'] && isset($value['id']))
			{
				$have_variant[] = $value['id'];
			}
		}

		$have_variant = array_filter($have_variant);
		$have_variant = array_unique($have_variant);

		if(empty($have_variant))
		{
			return;
		}

		$load_min_value = \lib\db\products\get::variants_load_min_value(implode(',', $have_variant));

		if(empty($load_min_value) || !is_array($load_min_value))
		{
			return;
		}

		$load_min_value = array_combine(array_column($load_min_value, 'parent'), $load_min_value);

		foreach ($list as $key => $value)
		{
			if(isset($value['id']) && isset($load_min_value[$value['id']]))
			{
				$min_price = $load_min_value[$value['id']];


				if(isset($min_price['finalprice']))
				{
					$list[$key]['finalprice'] = \lib\price::down($min_price['finalprice']);
				}

				if(isset($min_price['price']))
				{
					$list[$key]['price'] = \lib\price::down($min_price['price']);
				}

				if(isset($min_price['discount']))
				{
					$list[$key]['discount'] = \lib\price::down($min_price['discount']);
				}

				if(isset($min_price['discountpercent']))
				{
					$list[$key]['discountpercent'] = \lib\price::down($min_price['discountpercent']);
				}
			}
		}


	}



	public static function website_product_list($_option = null)
	{
		$type   = null;
		$cat_id = null;
		$tag_id = null;

		if(isset($_option['value']['productline']['type']))
		{
			$type = $_option['value']['productline']['type'];
		}

		if(isset($_option['value']['productline']['cat_id']))
		{
			$cat_id = $_option['value']['productline']['cat_id'];
		}

		$meta =
		[
			'limit' => 16,
			'type' => $type,
			'join' => [],
		];

		$and   = [];
		$or    = [];
		$order = null;

		$and[] = " products.status != 'deleted'";
		// $and[] = " products.instock = 'yes'";
		$and[] = " products.parent IS NULL ";


		if($cat_id)
		{
			$and[]  = " productcategoryusage.productcategory_id =  $cat_id ";
			$meta['join'][] = ' INNER JOIN productcategoryusage ON productcategoryusage.product_id = products.id ';
		}

		if($tag_id)
		{
			$and[]  = " producttagusage.producttag_id =  $tag_id ";
			$meta['join'][] = ' INNER JOIN producttagusage ON producttagusage.product_id = products.id ';
		}


		if($type === 'latestproduct')
		{
			$order = " products.instock ASC, products.id DESC ";
		}
		elseif($type === 'randomproduct')
		{
			$order = " products.instock ASC, RAND() ";

		}
		elseif($type === 'bestselling')
		{
			$order = " products.instock ASC, products.id ASC ";
		}
		else
		{
			$order = " products.instock ASC, products.id DESC ";
		}

		$last_product = \lib\db\products\get::website_last_product($and, $or, $order, $meta);

		if($last_product && is_array($last_product))
		{
			$last_product = array_map(['\\lib\\app\\product\\ready', 'row'], $last_product);
		}
		else
		{
			$last_product = [];
		}

		self::detect_min_variant_price($last_product);

		// var_dump($last_product);exit();
		return $last_product;
	}




	public static function get_similar_product($_product_id)
	{
		if(!$_product_id || !is_numeric($_product_id))
		{
			return [];
		}

		$limit = 6;

		$list = \lib\db\products\search::get_similar_product($_product_id, $limit);

		$found_ids = [];

		if(!$list || !is_array($list))
		{
			$list = [];
		}

		$found_ids = array_column($list, 'id');
		$found_ids = array_filter($found_ids);
		$found_ids = array_unique($found_ids);

		if(count($list) < $limit)
		{
			$list_2 = \lib\db\products\search::get_similar_product_category_last($_product_id, ($limit - count($list)), $found_ids);
			if(!$list_2 || !is_array($list_2))
			{
				$list_2 = [];
			}

			$list = array_merge($list, $list_2);

			$found_ids = array_column($list, 'id');
			$found_ids = array_filter($found_ids);
			$found_ids = array_unique($found_ids);
		}

		if(count($list) < $limit)
		{
			$list_3 = \lib\db\products\search::get_similar_product_last($_product_id, ($limit - count($list)), $found_ids);
			if(!$list_3 || !is_array($list_3))
			{
				$list_3 = [];
			}

			$list = array_merge($list, $list_3);
		}

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\product\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;

	}

}
?>