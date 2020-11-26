<?php
namespace lib\app\factor;


class add
{
	public static function my_sum($_array, $_column)
	{
		$sum = 0;

		if(is_array($_array))
		{
			foreach ($_array as $key => $value)
			{
				if(isset($value[$_column]))
				{
					$sum += floatval($value[$_column]);
				}
			}
		}

		return $sum;
	}

	public static function calculate_shipping_value($factor, $_option = [])
	{

		$shipping_value = 0;

		if(isset($_option['shipping_value']) &&  is_numeric($_option['shipping_value']))
		{
			$shipping_value = floatval($_option['shipping_value']);
			$factor['shipping'] = $shipping_value;
		}
		else
		{
			if(\dash\get::index($_option, 'mode') === 'customer')
			{
				$shipping = \lib\app\setting\get::shipping_setting();

				if(isset($shipping['sendbypost']) && $shipping['sendbypost'] && isset($shipping['sendbypostprice']) && $shipping['sendbypostprice'])
				{
					if(isset($shipping['freeshipping']) && $shipping['freeshipping'] && isset($shipping['freeshippingprice']) && $shipping['freeshippingprice'])
					{
						if(\lib\price::total_down($factor['total']) >= floatval($shipping['freeshippingprice']))
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
			}
			else
			{
				if(isset($_option['load_factor']['shipping']))
				{
					$shipping_value = floatval($_option['load_factor']['shipping']);

					$factor['shipping'] = $shipping_value;
				}
			}
		}


		$factor['shipping'] = $shipping_value;

		return $factor;
	}


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
			\dash\permission::access('factorSaleAdd');
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


		$factor['subprice']    = self::my_sum($factor_detail, 'sub_price_temp');
		$factor['subdiscount'] = self::my_sum($factor_detail, 'sub_discount_temp');
		$factor['subvat']      = self::my_sum($factor_detail, 'sub_vat_temp');
		$factor['subtotal']    = self::my_sum($factor_detail, 'sum');
		$factor['qty']         = self::my_sum($factor_detail, 'count');
		$factor['item']        = count($factor_detail);

		$factor['total']     = floatval($factor['subtotal']) - floatval($factor['discount']);

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

			$factor = self::calculate_shipping_value($factor, ['mode' => $mode]);

		}

		$factor['total']     = (floatval($factor['subtotal']) - floatval($factor['discount'])) + floatval($factor['shipping']);

		$factor['status']    = $factor['status'] ? $factor['status'] : 'registered';
		$factor['seller']    = \dash\user::id();
		$factor['date']      = date("Y-m-d H:i:s");
		$factor['title']     = null;
		$factor['pre']       = null;
		$factor['transport'] = null;
		$factor['desc']      = $factor['desc'];
		$factor['mode']      = $mode;


		// check max input size for factor
		$factor          = \lib\app\factor\check::value_max_limit($factor, $_option);

		if(!$factor || !\dash\engine\process::status())
		{
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

		$return              = [];
		$return['factor_id'] = $factor_id;
		$return['price']     = \lib\price::total_down($factor['total']);


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
			'count'      => 'bigint',
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

			if(!\dash\validate::bigint($new_count, false))
			{
				\dash\notif::error(T_("Data is out of range for column count"));
				return false;
			}

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

			if(!$factor_detail || !\dash\engine\process::status())
			{
				return false;
			}


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

		$ok = \lib\app\factor\calculate::again($load_factor['id']);

		if($ok)
		{
			\dash\db::commit();
			\dash\notif::ok(T_("Product added to factor"));
			return true;
		}
		else
		{
			\dash\db::rollback();
			return false;
		}



	}
}
?>
