<?php
namespace lib\app;


/**
 * Class for factor.
 */
class factor
{

	use \lib\app\factor\add;
	use \lib\app\factor\edit;
	use \lib\app\factor\datalist;
	use \lib\app\factor\get;
	use \lib\app\factor\balance;


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check_factor($_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		if(!\lib\userstore::id())
		{
			\dash\notif::error(T_("You are not in this store!"));
			return false;
		}


		$desc = \dash\app::request('desc');
		if($desc && mb_strlen($desc) > 1000)
		{
			\dash\notif::error(T_("Description of factor out of range"), 'desc');
			return false;
		}


		$type = \dash\app::request('type');
		if($type && !in_array($type, ['buy','sale','prefactor','lending','backbuy','backfactor','waste']))
		{
			\dash\notif::error(T_("Invalid type of factor"), 'type');
			return false;
		}

		if(!$type)
		{
			$type = 'sale';
		}

		$customer = \dash\app::request('customer');
		if(!$customer || $customer === '')
		{
			$customer = null;
		}

		if($customer)
		{
			$customer_id = \dash\coding::decode($customer);
			if($customer_id)
			{
				$customer_detail = \lib\db\userstores::get(['id' => $customer_id, 'store_id' => \lib\store::id(), 'limit' => 1]);
				if(!isset($customer_detail['id']))
				{
					\dash\notif::error(T_("Customer detail is invalid"), 'customer');
					return false;
				}
				else
				{
					$customer = $customer_detail['id'];
				}
			}
			else
			{
				// search in displayname of userstore
				$customer_detail = \lib\db\userstores::search_customer($customer, \lib\store::id());
				if(isset($customer_detail['id']))
				{
					$customer = $customer_detail['id'];
				}
				else
				{
					$customer = null;
				}
			}

			if($type === 'sale')
			{
				// everyone sell one time, is customer
				if(isset($customer_detail['id']) && !isset($customer_detail['customer']))
				{
					\lib\db\userstores::update(['customer' => 1], $customer_detail['id']);
				}
			}
		}

		$args                   = [];
		$args['customer']       = $customer;
		$args['type']           = $type;
		$args['seller']         = \lib\userstore::id();
		$args['date']           = date("Y-m-d H:i:s");
		$args['title']          = null;
		$args['pre']            = null;
		$args['transport']      = null;
		$args['pay']            = null;
		$args['detailsum']      = null;
		$args['detaildiscount'] = null;
		$args['detailtotalsum'] = null;
		$args['item']           = null;
		$args['qty']            = null;
		$args['vat']            = null;
		$args['discount']       = null;
		$args['sum']            = null;
		$args['status']         = null;
		$args['desc']           = $desc;

		return $args;
	}



	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check_factor_detail($_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$list    = \dash\app::request();

		$decode_list   = [];
		$allproduct_id = [];
		$new_list      = [];

		$have_warn     = [];

		foreach ($list as $key => $value)
		{
			$product_id = null;
			if(isset($value['product']))
			{
				$product_id = \dash\coding::decode($value['product']);
			}

			if(!$product_id)
			{
				$have_warn[] = $key + 1;
				continue;
			}

			if(!array_key_exists('count', $value))
			{
				$have_warn[] = $key + 1;
				continue;
			}

			if(!is_numeric($value['count']))
			{
				$have_warn[] = $key + 1;
				continue;
			}

			if(floatval($value['count']) == 0)
			{
				$have_warn[] = $key + 1;
				continue;
			}

			$continue = false;

			switch ($_option['type'])
			{
				case 'sale':
					if(isset($value['discount']) && $value['discount'] &&  !is_numeric($value['discount']))
					{
						$have_warn[] = $key + 1;
						$continue    = true;
						break;
					}
					// save query of sold plus and minus stock in cache to run multi query after this foreach
					self::sold_plus($product_id, floatval($value['count']), true);
					self::stock_minus($product_id, floatval($value['count']), true);
					break;

				case 'buy':
					// if(!array_key_exists('price', $value))
					// {
					// 	$have_warn[] = $key + 1;
					// 	continue;
					// }

					// if($value['price'] &&  !is_numeric($value['price']))
					// {
					// 	$have_warn[] = $key + 1;
					// 	continue;
					// }

					// $new_price      = floatval($value['price']);

					if(!array_key_exists('buyprice', $value))
					{
						$have_warn[] = $key + 1;
						$continue = true;
						break;
					}

					if($value['buyprice'] &&  !is_numeric($value['buyprice']))
					{
						$have_warn[] = $key + 1;
						$continue = true;
						break;
					}

					$new_buyprice      = floatval($value['buyprice']);

					$price_change                    = [];
					// $price_change['price']           = $new_price;
					// $price_change['discount']        = $value['discount'];
					$price_change['buyprice']        = $new_buyprice;

					// $discountpercent = null;
					// if(floatval($new_price) != 0)
					// {
					// 	$discountpercent = round((floatval($value['discount']) * 100) / floatval($new_price), 3);
					// }

					// $price_change['discountpercent'] = $discountpercent;

					\lib\app\product\buyprice::check($product_id, $price_change, true);

					self::stock_plus_and_buyprice($product_id, floatval($value['count']), true, $new_buyprice);

					break;

					// -------------------- prefactor
					case 'prefactor':
						// no thing
						break;

					// -------------------- backbuy
					case 'lending':
						self::stock_minus($product_id, floatval($value['count']), true);
						break;

					// -------------------- backbuy
					case 'backbuy':
						self::stock_minus($product_id, floatval($value['count']), true);
						break;

					// -------------------- backfactor
					case 'backfactor':
						self::sold_minus($product_id, floatval($value['count']), true);
						self::stock_plus($product_id, floatval($value['count']), true);
						break;

					// -------------------- wast
					case 'waste':
						self::stock_minus($product_id, floatval($value['count']), true);
						break;

					// invalid type
				default:
						\dash\notif::error(T_("Invalid factor type"), 'type');
						return false;
					break;
			}

			if($continue)
			{
				continue;
			}

			$new_list[$key]['count']      = floatval($value['count']);
			$new_list[$key]['discount']   = (isset($value['discount'])) ? intval($value['discount']) : null;
			$new_list[$key]['product_id'] = $product_id;

			$allproduct_id[]              = $product_id;
		}

		if(count($allproduct_id) <> count(array_unique($allproduct_id)))
		{
			\dash\notif::error(T_("Duplicate product in one factor founded"));
			return false;
		}

		$allproduct_id      = array_unique($allproduct_id);

		if(empty($allproduct_id))
		{
			\dash\notif::error(T_("No valid products found in your list"));
			return false;
		}

		// run the multi query to change every change in var static
		// for example in sold and stock
		self::change_var_static_multi_query();

		if(!empty($have_warn))
		{
			\dash\notif::warn(T_("Invalid product detail in some record of this factor, [:key]", ['key' => implode(',', $have_warn)]));
		}

		$check_true_product = \lib\db\products::check_multi_product_id($allproduct_id, \lib\store::id());
		$true_product_ids   = array_column($check_true_product, 'id');
		$check_true_product = array_combine($true_product_ids, $check_true_product);

		$factor_detail = [];

		foreach ($new_list as $key => $value)
		{
			$temp = [];

			if(!isset($check_true_product[$value['product_id']]))
			{
				\dash\notif::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
				return false;
			}

			$this_proudct = $check_true_product[$value['product_id']];

			$price = 0;

			switch ($_option['type'])
			{
				case 'sale':
					if(!array_key_exists('discount', $this_proudct))
					{
						\dash\notif::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
						return false;
					}

					if(array_key_exists('price', $this_proudct))
					{
						$price = floatval($this_proudct['price']);
					}

					$temp['discount']   = $value['discount'] === null ? $this_proudct['discount'] : $value['discount'];
					$temp['sum']        = (floatval($price) - floatval($value['discount'])) * floatval($value['count']);
					break;

				case 'buy':
					if(array_key_exists('buyprice', $this_proudct))
					{
						$price = floatval($this_proudct['buyprice']);
					}

					$temp['sum'] = floatval($price) * floatval($value['count']);
					break;

				case 'prefactor':
				case 'lending':
				case 'backbuy':
				case 'backfactor':
				case 'waste':

					break;
			}

			$temp['product_id'] = $value['product_id'];
			$temp['price']      = $price;
			$temp['count']      = $value['count'] === null ? 1 : $value['count'];

			$factor_detail[] = $temp;
		}

		return $factor_detail;
	}


	/**
	 * ready data of factor to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
				case 'store_id':
				case 'customer':
				case 'seller':
				case 'creator':

					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'datecreated':
				case 'datemodified':

					break;

				default:
					$result[$key] = isset($value) ? (string) $value : null;
					break;
			}
		}

		return $result;
	}
}
?>