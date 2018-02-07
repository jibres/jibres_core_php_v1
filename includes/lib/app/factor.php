<?php
namespace lib\app;
use \lib\utility;
use \lib\debug;

/**
 * Class for factor.
 */
class factor
{

	use \lib\app\factor\add;
	use \lib\app\factor\edit;
	use \lib\app\factor\datalist;
	use \lib\app\factor\get;
	use \lib\app\factor\dashboard;
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

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \lib\app::request(),
			]
		];

		$customer = \lib\app::request('customer');
		$customer = trim($customer);
		if(!$customer || $customer === '')
		{
			$customer = null;
		}

		if($customer)
		{
			$customer_id = \lib\utility\shortURL::decode($customer);
			if($customer_id)
			{
				$customer_detail = \lib\db\userstores::get(['id' => $customer, 'store_id' => \lib\store::id(), 'limit' => 1]);
				if(!isset($customer_detail['id']))
				{
					\lib\debug::error(T_("Customer detail is invalid"), 'customer');
					return false;
				}
				else
				{
					$customer = $customer_detail['id'];
				}
			}
			else
			{
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
			// every one sell one more time set this is a customer
			if(isset($customer_detail['id']) && !isset($customer_detail['customer']))
			{
				\lib\db\userstores::update(['customer' => 1], $customer_detail['id']);
			}
		}

		$desc = \lib\app::request('desc');
		if($desc && mb_strlen($desc) > 1000)
		{
			\lib\debug::error(T_("Description of factor out of range"), 'desc');
			return false;
		}

		$type = \lib\app::request('type');
		if($type && !in_array($type, ['buy','sell','prefactor','lending','backbuy','backfactor','waste']))
		{
			\lib\debug::error(T_("Invalid type of factor"), 'type');
			return false;
		}

		if(!$type)
		{
			$type = 'sell';
		}

		$args                   = [];
		$args['customer']       = $customer;
		$args['type']           = $type;
		$args['seller']         = \lib\userstore::id();
		$args['date']           = date("Y-m-d H:i:s");
		$args['shamsidate']     = \lib\utility\jdate::date("Ymd", time(), false);
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

		$list    = \lib\app::request();

		$decode_list   = [];
		$allproduct_id = [];
		$new_list      = [];

		$have_warn     = [];

		foreach ($list as $key => $value)
		{
			$product_id = null;
			if(isset($value['product']))
			{
				$product_id = \lib\utility\shortURL::decode($value['product']);
			}

			if(!$product_id)
			{
				$have_warn[] = $key + 1;
				continue;
			}

			if(!array_key_exists('count', $value) || !array_key_exists('discount', $value))
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

			if($value['discount'] &&  !is_numeric($value['discount']))
			{
				$have_warn[] = $key + 1;
				continue;
			}

			switch ($_option['type'])
			{
				case 'sell':
					// save query of sold plus and minus stock in cache to run multi query after this foreach
					self::sold_plus($product_id, floatval($value['count']), true);
					self::stock_minus($product_id, floatval($value['count']), true);
					break;

				case 'buy':
					if(!array_key_exists('price', $value))
					{
						$have_warn[] = $key + 1;
						continue;
					}

					if($value['price'] &&  !is_numeric($value['price']))
					{
						$have_warn[] = $key + 1;
						continue;
					}

					$new_price      = floatval($value['price']);

					if(!array_key_exists('buyprice', $value))
					{
						$have_warn[] = $key + 1;
						continue;
					}

					if($value['buyprice'] &&  !is_numeric($value['buyprice']))
					{
						$have_warn[] = $key + 1;
						continue;
					}

					$new_buyprice      = floatval($value['buyprice']);

					$price_change                    = [];
					$price_change['price']           = $new_price;
					$price_change['discount']        = $value['discount'];
					$price_change['buyprice']        = $new_buyprice;

					$discountpercent = null;
					if(floatval($new_price) != 0)
					{
						$discountpercent = round((floatval($value['discount']) * 100) / floatval($new_price), 3);
					}

					$price_change['discountpercent'] = $discountpercent;

					\lib\app\product::buyprice_check($product_id, $price_change);

					self::stock_plus($product_id, floatval($value['count']), true);
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
						\lib\debug::error(T_("Invalid factor type"), 'type');
						return false;
					break;
			}

			$new_list[$key]['count']      = floatval($value['count']);
			$new_list[$key]['discount']   = intval($value['discount']);
			$new_list[$key]['product_id'] = $product_id;

			$allproduct_id[]              = $product_id;
		}

		// run the multi query to change every change in var static
		// for example in sold and stock
		self::change_var_static_multi_query();

		if(count($allproduct_id) <> count(array_unique($allproduct_id)))
		{
			\lib\debug::error(T_("Duplicate product in one factor founded"));
			return false;
		}

		$allproduct_id      = array_unique($allproduct_id);

		if(empty($allproduct_id))
		{
			\lib\debug::error(T_("No valid products found in your list"));
			return false;
		}

		if(!empty($have_warn))
		{
			\lib\debug::warn(T_("Invalid product detail in some record of this factor, [:key]", ['key' => implode(',', $have_warn)]));
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
				\lib\debug::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
				return false;
			}

			if(!array_key_exists('discount', $check_true_product[$value['product_id']]))
			{
				\lib\debug::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
				return false;
			}

			$this_proudct = $check_true_product[$value['product_id']];

			if(!array_key_exists('price', $this_proudct))
			{
				$price = 0;
			}
			else
			{
				$price = intval($this_proudct['price']);
			}

			$temp['product_id'] = $value['product_id'];
			$temp['price']      = $price;
			$temp['count']      = $value['count'] === null ? 1 : $value['count'];
			$temp['discount']   = $value['discount'] === null ? $check_true_product[$value['product_id']]['discount'] : $value['discount'];
			$temp['sum']        = (floatval($price) - floatval($value['discount'])) * floatval($value['count']);

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
						$result[$key] = \lib\utility\shortURL::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'datecreated':
				case 'datemodified':
					continue;
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