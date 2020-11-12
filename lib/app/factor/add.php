<?php
namespace lib\app\factor;


class add
{

	/**
	 * add new factor
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function new_factor($_factor, $_factor_detail, $_option = [])
	{
		$default_option =
		[
			'debug'     => true,
			'factor_id' => null,
			'from_cart' => false,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		// store not loaded!
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"), 'subdomain');
			return false;
		}

		if(!$_option['from_cart'])
		{
			// check permission to add new factor
			\dash\permission::access('factorAccess');
		}

		// check args
		$factor          = \lib\app\factor\check::factor($_factor, $_option);

		$_option['type'] = $factor['type'];

		if(!$factor || !\dash\engine\process::status())
		{
			return false;
		}

		$factor_detail = \lib\app\factor\check_detail::factor_detail($_factor_detail, $_option);

		if(!$factor_detail || !\dash\engine\process::status())
		{
			return false;
		}


		$factor['subprice']    = array_sum(array_column($factor_detail, 'sub_price_temp'));
		$factor['subdiscount'] = array_sum(array_column($factor_detail, 'sub_discount_temp'));
		$factor['subvat']      = array_sum(array_column($factor_detail, 'sub_vat_temp'));;
		$factor['subtotal']    = array_sum(array_column($factor_detail, 'sum'));
		$factor['qty']         = array_sum(array_column($factor_detail, 'count'));
		$factor['item']        = count($factor_detail);
		$factor['discount']    = $factor['discount'];

		$factor_total = floatval($factor['subtotal']) - floatval($factor['discount']);

		if($factor['discount'])
		{
			if(floatval($factor['discount']) > floatval($factor['subtotal']))
			{
				\dash\notif::error(T_("Discount is larger than order total"));
				return false;
			}
		}

		// the factor mode
		$mode = 'admin';

		if($_option['from_cart'])
		{
			// change factor mode to customer
			$mode = 'customer';

			$shipping_value = 0;
			$shipping = \lib\app\setting\get::shipping_setting();

			if(isset($shipping['sendbypost']) && $shipping['sendbypost'] && isset($shipping['sendbypostprice']) && $shipping['sendbypostprice'])
			{
				if(isset($shipping['freeshipping']) && $shipping['freeshipping'] && isset($shipping['freeshippingprice']) && $shipping['freeshippingprice'])
				{
					if(\lib\price::total_down($factor_total) >= floatval($shipping['freeshippingprice']))
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

			if($shipping_value)
			{
				$shipping_value = \lib\price::up($shipping_value);
				$factor['shipping'] = $shipping_value;

				$shipping_value = \lib\number::up($shipping_value);
				$factor_total = floatval($factor_total) + $shipping_value;
			}

		}

		$factor['total']     = $factor_total;

		$factor['status']    = $factor['status'] ? $factor['status'] : 'draft';
		$factor['seller']    = \dash\user::id();
		$factor['date']      = date("Y-m-d H:i:s");
		$factor['title']     = null;
		$factor['pre']       = null;
		$factor['transport'] = null;
		$factor['pay']       = null;
		$factor['desc']      = $factor['desc'];
		$factor['mode']      = $mode;


		// qty field in int(10)
		if( $factor['qty'] && !\dash\validate::int($factor['qty'], false))
		{
			\dash\notif::error(T_("Data is out of range for column qty"), 'qty');
			return false;
		}

		// item field in bigint(20)
		if( $factor['item'] && !\dash\validate::bigint($factor['item'], false))
		{
			\dash\notif::error(T_("Data is out of range for column item"), 'item');
			return false;
		}

		// subprice field in bigint(20)
		if( $factor['subprice'] && !\dash\validate::bigint($factor['subprice'], false))
		{
			\dash\notif::error(T_("Data is out of range for column subprice"), 'subprice');
			return false;
		}

		// subdiscount field in bigint(20)
		if( $factor['subdiscount'] && !\dash\validate::bigint($factor['subdiscount'], false))
		{
			\dash\notif::error(T_("Data is out of range for column subdiscount"), 'subdiscount');
			return false;
		}


		// subtotal field in bigint(20)
		if( $factor['subtotal'] && !\dash\validate::bigint($factor['subtotal'], false))
		{
			\dash\notif::error(T_("Data is out of range for column subtotal"), 'subtotal');
			return false;
		}

		// total field in bigint(20)
		if( $factor['total'] && !\dash\validate::bigint($factor['total'], false))
		{
			\dash\notif::error(T_("Data is out of range for column total"), 'total');
			return false;
		}


		// start transaction of db
		\dash\db::transaction();

		if(!$_option['factor_id'])
		{
			$factor_id = \lib\db\factors\insert::new_record($factor);
		}
		else
		{
			$factor_id = $_option['factor_id'];
		}


		if(!$factor_id)
		{
			\dash\log::set('factor:no:way:to:insert:factor');
			\dash\notif::error(T_("No way to insert factor"));
			\dash\db::rollback();
			return false;
		}

		$return = [];

		$return['factor_id'] = 'JF'. $factor_id;
		$return['factor_id'] = $factor_id;

		$return['price'] = \lib\price::total_down($factor_total);


		$product_need_track_stock = [];

		foreach ($factor_detail as $key => $value)
		{
			$factor_detail[$key]['factor_id'] = $factor_id;
			unset($factor_detail[$key]['sub_price_temp']);
			unset($factor_detail[$key]['sub_discount_temp']);
			unset($factor_detail[$key]['sub_vat_temp']);

			if($value['track_stock_temp'])
			{
				$product_need_track_stock[] = $value;
			}

			unset($factor_detail[$key]['track_stock_temp']);

		}

		$add_detail = \lib\db\factordetails\insert::multi_insert($factor_detail);

		if(!$add_detail)
		{
			\dash\db::rollback();
			return false;
		}

		foreach ($product_need_track_stock as $key => $value)
		{
			\lib\app\product\inventory::set('sale', $value['count'], $value['product_id'], $factor_id);
			$get_stock = \lib\app\product\inventory::get($value['product_id']);
			if(!is_null($get_stock))
			{
				if($get_stock <= 0)
				{
					\lib\app\product\edit::out_of_stock($value['product_id']);
				}
			}
		}

		if(\dash\engine\process::status())
		{
			\dash\db::commit();
			\dash\notif::ok(T_("Factor successfuly added"));
		}

		return $return;
	}


	public static function add_product($_args, $_factor_id)
	{
		$condition =
		[
			'product_id' => 'id',
			'count'      => 'int',
			'price'      => 'price',
			'discount'   => 'price',
		];

		$require = ['product_id', 'count'];

		$meta =
		[
			'field_title' =>
			[
				'product_id' => 'product',
			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$load_factor = \lib\app\factor\get::inline_get($_factor_id);
		if(!$load_factor)
		{
			return false;
		}

		$load_product = \lib\app\product\get::get($data['product_id']);
		if(!$load_product)
		{
			return false;
		}

		\dash\db::transaction();

		$add_new_record = true;

		$price = $data['price'];
		if($price === null)
		{
			$price = $load_product['price'];
		}

		$discount = $data['discount'];
		if($discount === null)
		{
			$discount = $load_product['discount'];
		}

		$count      = $data['count'];

		// check exist this product in factor and plus the count
		$check_exist = \lib\db\factordetails\get::check_exist_record($load_factor['id'], $data['product_id'], \lib\price::up($price), \lib\price::up($discount));

		if(isset($check_exist['id']))
		{
			$add_new_record = false;

			$new_count = floatval(\lib\number::up($data['count'])) + floatval($check_exist['count']);

			\lib\db\factordetails\update::record(['count' => $new_count], $check_exist['id']);

			\lib\app\factor\edit::refresh_detail_record($check_exist['id']);
		}

		if($add_new_record)
		{
			$option = [];
			$option['type'] = $load_factor['type'];

			$ready = [];
			$ready[] =
			[
				'product'  => $data['product_id'],
				'price'    => $price,
				'discount' => $discount,
				'count'    => $count,
			];

			$factor_detail = \lib\app\factor\check_detail::factor_detail($ready, $option);

			foreach ($factor_detail as $key => $value)
			{
				$factor_detail[$key]['factor_id'] = $load_factor['id'];
				unset($factor_detail[$key]['sub_price_temp']);
				unset($factor_detail[$key]['sub_discount_temp']);
				unset($factor_detail[$key]['sub_vat_temp']);
				unset($factor_detail[$key]['track_stock_temp']);

			}

			$add_detail = \lib\db\factordetails\insert::multi_insert($factor_detail);

			if(!$add_detail)
			{
				\dash\db::rollback();
				return false;
			}

		}

		\lib\app\factor\calculate::again($load_factor['id']);

		\dash\db::commit();

		\dash\notif::ok(T_("Product added to factor"));

		return true;

	}
}
?>
