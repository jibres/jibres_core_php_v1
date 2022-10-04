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
			'order'          => 'order',
			'sort'           => ['enum' => ['title','price','buyprice', 'finalprice', 'discount']],
			'status'         => ['enum' => ['draft','active','deleted', 'archive']],
			'limit'          => 'int',
			'barcode'        => 'barcode',
			'price'          => 'price',
			'buyprice'       => 'price',
			'discount'       => 'price',
			'tag_id'         => 'id', // need remove it later
			'cat_id'         => 'id',
			'tag_with_child' => 'bit',
			'unit_id'        => 'id',
			'website_order'  => 'string_50',

			'dup'            => 'bit',
			'bar'            => 'y_n',
			'bup'            => 'y_n',
			'p'              => 'y_n',
			'd'              => 'y_n',
			'st'             => 'y_n',
			'nst'            => 'y_n',
			'g'              => 'y_n',
			'v'              => 'y_n',
			'so'             => 'y_n',
			'w'              => 'y_n',
			't'              => 'y_n',
			'hvat'           => 'y_n',
			'tq'             => 'y_n',
			'pr'             => 'y_n', // property

			'exp'            => 'y_n',
			'maxd'           => 'bit',

			'websitemode'    => 'bit',

			'pagination'     => 'yes_no',
			'included_category'     => 'bit',
		];




		$require = [];
		$meta    = [];
		$param   = [];

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

		if($data['pagination'] === 'no')
		{
			$meta['pagination']                  = false;
		}

		$order_sort  = null;


		if($data['barcode'])
		{
			$and[] = " ( products.barcode  = :s_barcode OR products.barcode2 = :s_2barcode ) ";
			$param[':s_barcode']  = $data['barcode'];
			$param[':s_2barcode'] = $data['barcode'];
			self::$is_filtered    = true;
		}

		if($data['price'])
		{
			$and[] = " products.price = :s_price ";
			$param[':s_price'] = $data['price'];
		}

		if($data['buyprice'])
		{
			$and[] = " products.buyprice = :s_buyprice ";
			$param[':s_buyprice'] = $data['buyprice'];
			self::$is_filtered        = true;
		}


		if($data['discount'])
		{
			$and[] = " products.discount = :s_discount ";
			$param[':s_discount'] = $data['discount'];
			self::$is_filtered        = true;
		}

		if($data['cat_id'])
		{
			if($data['tag_with_child'])
			{
				$get_all_child_id = \lib\db\productcategory\get::all_child_id($data['cat_id']);

				if(!is_array($get_all_child_id))
				{
					$get_all_child_id = [];
				}

				$get_all_child_id[] = $data['cat_id'];

				$get_all_child_id = array_unique($get_all_child_id);

				$all_child_id = implode(",", $get_all_child_id);

				$and[]   = " productcategoryusage.productcategory_id IN ($all_child_id) ";
				$join[] = ' INNER JOIN productcategoryusage ON productcategoryusage.product_id = products.id ';
				$type = 'catusage';
				self::$is_filtered        = true;
			}
			else
			{
				$and[]   = " productcategoryusage.productcategory_id =  :s_j_cat_id ";
				$param['s_j_cat_id'] = $data['cat_id'];

				$join[] = ' INNER JOIN productcategoryusage ON productcategoryusage.product_id = products.id ';
				$type = 'catusage';
				self::$is_filtered        = true;
			}
		}
		else
		{

			// tag
			if(isset($data['t']) && $data['t'] === 'y')
			{
				$and[]  = " productcategoryusage.productcategory_id IS NOT NULL ";
				$join[] = ' INNER JOIN productcategoryusage ON productcategoryusage.product_id = products.id ';
				self::$is_filtered             = true;
			}
			elseif(isset($data['t']) && $data['t'] === 'n')
			{
				$and[]  = " productcategoryusage.productcategory_id IS NULL ";
				$join[] = ' LEFT JOIN productcategoryusage ON productcategoryusage.product_id = products.id ';
				self::$is_filtered             = true;
			}

		}


		// property
		if(isset($data['pr']) && $data['pr'] === 'y')
		{
			$and[]  = " productproperties.product_id IS NOT NULL ";
			$join[] = ' INNER JOIN productproperties ON productproperties.product_id = products.id ';
			self::$is_filtered             = true;
		}
		elseif(isset($data['pr']) && $data['pr'] === 'n')
		{
			$and[]  = " productproperties.product_id IS NULL ";
			$join[] = ' LEFT JOIN productproperties ON productproperties.product_id = products.id ';
			self::$is_filtered             = true;
		}


		if($data['unit_id'])
		{
			$and[] = "products.unit_id = :s_unit_id ";
			$param[':s_unit_id'] = $data['unit_id'];
			self::$is_filtered = true;
		}


		// ------------------------------------------------------------------------------ SET FILTERS
		// set filter

		if(isset($data['dup']) && $data['dup'])
		{
			self::$is_filtered              = true;
			$join[] = "	INNER JOIN 	(SELECT title FROM products GROUP BY title	HAVING COUNT(*) > 1) dup ON products.title = dup.title";

			$order_sort   = ' products.title ASC';
		}



		// barcode
		if(isset($data['hvat']) && $data['hvat'] === 'y')
		{
			$and[] = " products.vat = 'yes' ";
			self::$is_filtered       = true;
		}
		elseif(isset($data['hvat']) && $data['hvat'] === 'n')
		{
			$and[] = " ( products.vat IS NULL OR products.vat = 'no' )";
			self::$is_filtered       = true;
		}


		// barcode
		if(isset($data['bar']) && $data['bar'] === 'y')
		{
			$and[] = " ( products.barcode IS NOT NULL OR products.barcode2 IS NOT NULL )";
			self::$is_filtered       = true;
		}
		elseif(isset($data['bar']) && $data['bar'] === 'n')
		{
			$and[] = " ( products.barcode IS NULL AND products.barcode2 IS NULL )";
			self::$is_filtered       = true;
		}

		// buyprice
		if(isset($data['bup']) && $data['bup'] === 'y')
		{
			$and[] = "(products.buyprice IS NOT NULL )";
			self::$is_filtered            = true;
		}
		elseif(isset($data['bup']) && $data['bup'] === 'n')
		{
			$and[] = "(products.buyprice IS NULL OR products.buyprice = 0 )";
			self::$is_filtered            = true;
		}

		// price
		if(isset($data['p']) && $data['p'] === 'y')
		{
			$and[] = "(products.price IS NOT NULL )";
			self::$is_filtered            = true;
		}
		elseif(isset($data['p']) && $data['p'] === 'n')
		{
			$and[] = "(products.price IS NULL OR products.price = 0 )";
			self::$is_filtered            = true;
		}


			// price
		if(isset($data['tq']) && $data['tq'] === 'y')
		{
			$and[] = " products.trackquantity  = 'yes' ";

			self::$is_filtered            = true;
		}
		elseif(isset($data['tq']) && $data['tq'] === 'n')
		{
			$and[] = " ( products.trackquantity  = 'no' OR products.trackquantity  IS NULL ) ";
			self::$is_filtered            = true;
		}


		// discount
		if(isset($data['d']) && $data['d'] === 'y')
		{
			$and[] = "(products.discount IS NOT NULL AND products.discount > 0 )";
			$type                         = 'discount';
			self::$is_filtered            = true;
		}
		elseif(isset($data['d']) && $data['d'] === 'n')
		{
			$and[] = "(products.discount IS NULL OR products.discount = 0 )";
			self::$is_filtered            = true;
		}


		// stock
		if(isset($data['st']) && $data['st'] === 'y')
		{
			$and['inStockeCheck'] = "products.instock  = 'yes' ";
			self::$is_filtered        = true;
		}
		elseif(isset($data['st']) && $data['st'] === 'n')
		{
			$and['inStockeCheck'] = "( products.instock  = 'no' OR products.instock  IS NULL )";
			$and[] = " (SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) >= 0 ";
			self::$is_filtered        = true;
		}

		// negative stock
		if(isset($data['nst']) && $data['nst'] === 'y')
		{
			unset($and['inStockeCheck']);
			$and[] = " (SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) < 0 ";
			self::$is_filtered        = true;
		}

		// gallery
		if(isset($data['g']) && $data['g'] === 'y')
		{
			$and[] = "products.thumb IS NOT NULL";
			self::$is_filtered        = true;
		}
		elseif(isset($data['g']) && $data['g'] === 'n')
		{
			$and[] = "products.thumb IS NULL";
			self::$is_filtered        = true;
		}

		// variants
		if(isset($data['v']) && $data['v'] === 'y')
		{
			$and[] = " products.variant_child  = 1 ";
			self::$is_filtered        = true;
		}
		elseif(isset($data['v']) && $data['v'] === 'n')
		{
			$and[] = " products.variant_child  != 1 ";
			self::$is_filtered        = true;
		}

		// sold
		if(isset($data['so']) && $data['so'] === 'y')
		{
			$and[] = " (SELECT factordetails.product_id FROM factordetails WHERE factordetails.product_id = products.id AND factordetails.status = 'enable' LIMIT 1) IS NOT NULL ";
			self::$is_filtered        = true;
		}
		elseif(isset($data['so']) && $data['so'] === 'n')
		{
			$and[] = " (SELECT factordetails.product_id FROM factordetails WHERE factordetails.product_id = products.id AND factordetails.status = 'enable' LIMIT 1) IS NULL ";
			self::$is_filtered        = true;
		}

		// weight
		if(isset($data['w']) && $data['w'] === 'y')
		{
			$and[] = "(products.weight IS NOT NULL OR products.weight != 0 )";
			self::$is_filtered             = true;
		}
		elseif(isset($data['w']) && $data['w'] === 'n')
		{
			$and[] = "(products.weight IS NULL OR products.weight = 0 )";
			self::$is_filtered             = true;
		}

		if($data['status'])
		{
			$and[] = " products.status = :s_status ";
			$param[':s_status'] = $data['status'];

			self::$is_filtered           = true;
		}
		else
		{
			$and[] = " products.status NOT IN ('deleted', 'archive') ";
		}

		if($data['websitemode'])
		{
			$and[] = " products.saleonline = 'yes' ";
			$and['parent_is_null'] = " products.parent IS NULL ";
		}


		$query_string = \dash\validate::search($_query_string, false);
		if(!is_null($query_string))
		{

			if(substr($query_string, 0, 1) === '+' && is_numeric(\dash\number::clean(substr($query_string, 1))))
			{
				$search         = substr($query_string, 1);
				$search         = \dash\number::clean($search);

				$and[]                    = " ( products.finalprice = :s_2_finalprice OR products.price = :s_2_price )";
				$param[':s_2_finalprice'] = floatval($search);
				$param[':s_2_price']      = floatval($search);

				$and[] = "products.barcode IS NULL";
				$and[] = "products.barcode2 IS NULL";
				$meta['pagination']                  = false;

				$type                         = 'price_factor_count';

				self::$is_filtered = true;
			}
			elseif($query_string)
			{
				$or[]        = " products.title LIKE :query_string ";
				$param[':query_string'] = '%'. $query_string. '%';

				// $or['products.slug']     = ["LIKE", "'$query_string%'"];

				$query_string_barcode = \dash\utility\convert::to_barcode($query_string);

				if($query_string_barcode)
				{
					$or[]                        = " products.barcode = :products_barcode ";
					$or[]                        = " products.barcode2 = :products_barcode2 ";

					$param[':products_barcode']  = $query_string;
					$param[':products_barcode2'] = $query_string;
				}

				$or[]      = "products.sku = :products_sku ";
				$param[':products_sku'] = $query_string;

				if(is_numeric($query_string) || is_numeric(\dash\utility\convert::to_en_number($query_string)))
				{
					$search_price = \dash\utility\convert::to_en_number($query_string);

					$or[] = "products.finalprice = :s_3_finalprice ";
					$or[] = "products.price = :s_3_price ";

					$param[':s_3_finalprice'] = floatval($search_price);
					$param[':s_3_price']      = floatval($search_price);

					if($search_product_id = \dash\validate::id($search_price, false))
					{
						$or[] = "products.id = :search_by_product_id";
						$param[':search_by_product_id'] = $search_product_id;

						$or[] = " (products.id = (SELECT products.parent FROM products WHERE products.id = :search_2_by_product_id LIMIT 1)) ";
						$param[':search_2_by_product_id'] = $search_product_id;
					}
					// $or[] = "products.parent = ". $search_price;

					// unset($and['parent_is_null']);
					// unset($_where['parent_is_null']);
				}

				self::$is_filtered = true;
			}

		}

		$price_desc_sort = "IF(products.variant_child, (SELECT MAX(mSP.%s) FROM products AS `mSP` WHERE mSP.status = 'active' AND mSP.parent = products.id) ,products.%s)";
		$price_asc_sort  = "IF(products.variant_child, (SELECT MIN(mSP.%s) FROM products AS `mSP` WHERE mSP.status = 'active' AND mSP.parent = products.id) ,products.%s)";
		$instock_first   = "FIELD(products.instock, 'yes', NULL, 'no')";

		$order = null;

		$inexpensive = null;


		if($data['sort'] && !$order_sort)
		{

			$check_order_trust = \lib\app\product\filter::check_allow($data['sort'], $data['order'], $type);

			if($check_order_trust)
			{
				$sort = \dash\str::mb_strtolower($data['sort']);
				if($data['order'])
				{
					$order = \dash\str::mb_strtolower($data['order']);
				}

				if($sort === 'finalprice' || $sort === 'price' || $sort === 'buyprice' || $sort === 'discount')
				{
					if($order === 'asc')
					{
						$inexpensive = false;
						$order_sort = sprintf($price_asc_sort, $sort, $sort, $sort);
					}
					else
					{
						$inexpensive = true;
						$order_sort = sprintf($price_desc_sort, $sort, $sort, $sort);
					}
				}
				else
				{
					$order_sort = " $sort ";
				}

			}
		}


		if(!$order_sort)
		{
			$order_sort = " products.id DESC";
		}


		if($data['website_order'])
		{
			switch ($data['website_order'])
			{
				case 'oldest':
					$order_sort = "products.id ASC";
					break;

				case 'random':
					$order_sort = "RAND() ";
					break;

				case 'expensive':
					$order_sort = "products.finalprice DESC ";
					break;

				case 'inexpensive':
					$order_sort = "ISNULL(products.finalprice), products.finalprice ASC ";
					break;

				case 'latest':
				default:
					$order_sort = "products.id DESC";
					break;
			}
		}

		if($data['maxd'] === 'y')
		{
			$sort       = 'discount';
			$order      = 'desc';
			$order_sort = sprintf($price_desc_sort, $sort, $sort, $sort);
		}

		if($data['exp'] === 'y')
		{
			$sort       = 'finalprice';
			$order      = 'desc';
			$order_sort = sprintf($price_desc_sort, $sort, $sort, $sort);
			$inexpensive = true;
		}
		elseif($data['exp'] === 'n')
		{
			$sort       = 'finalprice';
			$order      = 'asc';
			$order_sort = sprintf($price_asc_sort, $sort, $sort, $sort);
		}

		if($data['websitemode'] || $data['website_order'])
		{
			$order_sort = " $instock_first, $order_sort";
		}

		\dash\temp::set('productSearchInexpensive', $inexpensive);

		$order_sort = " ORDER BY $order_sort $order";

		$and = array_merge($and, $_where);

		$meta['join'] = $join;
		// var_dump($and, $or, $meta);exit();
		// var_dump($and, $or, $meta, $order_sort);exit;

		switch ($type)
		{
			case 'price_factor_count':
				$list = \lib\db\products\search::list_join_price_factor_count($param, $and, $or, $order_sort, $meta);
				break;


			case 'no-duplicatetitle':
				// no result found by duplicate  title
				$list = [];
				break;

			default:
				$list = \lib\db\products\search::list($param, $and, $or, $order_sort, $meta);
				break;
		}


		if(is_array($list) && $list)
		{
			self::find_stock_list($list);

			if($data['included_category'])
			{
				self::load_category($list);
			}

			$list = array_map(['\\lib\\app\\product\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}


	private static function find_stock_list(&$list)
	{
		// stock
		$ids = array_column($list, 'id');

		$myList = array_combine(array_column($list, 'id'), $list);

		$ids = implode(',', $ids);

		$load_multi_stock = \lib\db\productinventory\get::multi_product_stock($ids);

		if(!is_array($load_multi_stock))
		{
			$load_multi_stock = [];
		}

		$load_multi_stock = array_combine(array_column($load_multi_stock, 'product_id'), $load_multi_stock);

		foreach ($myList as $productID => $productDetail)
		{
			if(is_null(a($productDetail, 'variant_child')) && isset($load_multi_stock[$productID]['stock']))
			{
				$myList[$productID]['stock'] = $load_multi_stock[$productID]['stock'];
			}
		}

		$list = array_values($myList);
	}


	private static function load_category(&$list)
	{
		// stock
		$ids = array_column($list, 'id');

		$myList = array_combine(array_column($list, 'id'), $list);

		$ids = implode(',', $ids);


		$load_multi_category = \lib\db\productcategoryusage\get::multi_usage($ids);

		if(!is_array($load_multi_category))
		{
			$load_multi_category = [];
		}

		$load_multi_category = array_combine(array_column($load_multi_category, 'product_id'), $load_multi_category);

		foreach ($load_multi_category as $key => $value)
		{
			if(!is_array(a($myList, $value['product_id'], 'category_list')))
			{
				$myList[$value['product_id']]['category_list'] = [];
			}

			$myList[$value['product_id']]['category_list'][] = ['title' => $value['title'], 'slug' => $value['slug']];

		}


		$list = array_values($myList);
	}


	public static function variant_list($_query_string, $_args)
	{
		$and   = [];
		$and['parent_is_null'] = "products.parent IS NULL ";

		$list = self::products_list('variants', $_query_string, $_args, $and);

		self::load_variants($list);


		return $list;
	}



	public static function website_product_search($_query_string, $_args)
	{
		$and   = [];
		$and['parent_is_null'] = "products.parent IS NULL ";
		$_args['status'] = 'active';

		$list = self::products_list('variants', $_query_string, $_args, $and);

		self::detect_min_variant_price($list);


		return $list;
	}


	/**
	 * Return all product + variants
	 *
	 *
	 * @param      <type>  $_query_string  The query string
	 * @param      <type>  $_args          The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function website_all_product_search($_query_string, $_args)
	{
		$and   = [];

		$_args['status'] = 'active';

		$list = self::products_list('price', $_query_string, $_args, $and);

		self::detect_min_variant_price($list);


		return $list;
	}




	public static function list_in_sale($_query_string, $_args)
	{
		if(!a($_args, 'limit'))
		{
			$_args['limit'] = 25;
		}
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

		foreach ($list as $key => $value)
		{
			if(isset($value['variant_child']) && $value['variant_child'])
			{
				$list[$key]['stock'] = floatval(\lib\db\productinventory\get::product_variant_stock($value['id']));
			}
		}


		$product_ids = array_column($list, 'id');
		$product_ids = array_map('floatval', $product_ids);

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

						$min_price = floatval($variants[$value['id']]['min_price']);
						$max_price = floatval($variants[$value['id']]['max_price']);
						if($min_price !== $max_price)
						{
							$min_price = \dash\fit::number($min_price);
							$max_price = \dash\fit::number($max_price);

							$list[$key]['variant_price'] = $min_price . ' ... '. $max_price;
						}
						else
						{
							$list[$key]['variant_price'] = \dash\fit::number($min_price);
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

		if(\dash\temp::get('productSearchInexpensive'))
		{
			$load_min_value = \lib\db\products\get::variants_load_max_value(implode(',', $have_variant));
		}
		else
		{
			$load_min_value = \lib\db\products\get::variants_load_min_value(implode(',', $have_variant));
		}


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
					$list[$key]['finalprice'] = floatval($min_price['finalprice']);
				}

				if(isset($min_price['price']))
				{
					$list[$key]['price'] = floatval($min_price['price']);
				}

				if(isset($min_price['discount']))
				{
					$list[$key]['discount'] = floatval($min_price['discount']);
				}

				if(isset($min_price['discountpercent']))
				{
					$list[$key]['discountpercent'] = floatval($min_price['discountpercent']);
				}
			}
		}


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