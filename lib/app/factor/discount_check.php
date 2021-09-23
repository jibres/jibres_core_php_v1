<?php
namespace lib\app\factor;


class discount_check
{
	private static $result = [];
	private static $load_all_dedicated = false;


	public static function get_result()
	{
		self::$result = [];

		// first check and fill $result
		self::check(...func_get_args());

		return self::$result;
	}


	/**
	 * Save error in msg variable
	 *
	 * @param      <type>  $_msg   The message
	 * @param      string  $_mode  The mode
	 */
	private static function error($_msg, $_mode = 'danger')
	{
		self::$result['msg_class'] = $_mode;
		self::$result['msg']       = $_msg;
	}


	/**
	 * Loads all dedicated.
	 *
	 * @param      <type>  $_discount_id  The discount identifier
	 */
	private static function load_all_dedicated($_discount_id, $_need = null)
	{
		if(!self::$load_all_dedicated)
		{
			$list = \lib\app\discount\dedicated::load_all_dedicated($_discount_id, true);


			$result                           = [];
			$result['special_products']       = [];
			$result['special_category']       = [];
			$result['special_customer_group'] = [];
			$result['special_customer']       = [];
			$result['special_country']        = [];
			$result['special_province']       = [];
			$result['special_city']           = [];
			$result['other']                  = [];


			foreach ($list as $key => $value)
			{
				if(array_key_exists(a($value, 'type'), $result))
				{
					$result[$value['type']][] = $value;
				}
			}

			self::$load_all_dedicated = $result;
		}

		if($_need)
		{
			return a(self::$load_all_dedicated, $_need);
		}
		else
		{
			return self::$load_all_dedicated;
		}
	}


	/**
	 * Load discount code and check is valid
	 * if is valid discount code calculate discount price
	 * else make msg to show in design
	 *
	 * @param      <type>  $_discount_code  The discount code
	 * @param      <type>  $_factor         The factor
	 * @param      <type>  $_factor_detail  The factor detail
	 */
	public static function check($_discount_code, $_factor, $_factor_detail)
	{

		/*----------  validate discount string code  ----------*/
		$discount_code = \dash\validate::discount_code($_discount_code, false);

		if(!$discount_code)
		{
			self::error(T_("Invalid Discount code"));
			return false;
		}

		/*----------  load discount code  ----------*/
		$load = \lib\app\discount\get::by_code($discount_code);

		if(!$load)
		{
			self::error(T_("Discount not found"));
			return false;
		}

		// save discount id
		$discount_id = $load['id'];

		/*----------  check status  ----------*/
		if(a($load, 'status') !== 'enable')
		{
			self::error(T_("Discount is not enable"));
			return false;
		}

		if($load['startdate'])
		{
			if(time() < strtotime($load['startdate']))
			{
				self::error(T_("Discount is not available at this time."));
				return false;
			}
		}

		if($load['enddate'])
		{
			if(time() > strtotime($load['enddate']))
			{
				self::error(T_("Discount was expired"));
				return false;
			}
		}

		/*----------  check minpurchase  ----------*/
		if($load['type'] === 'percentage')
		{
			if($load['minrequirements'] === 'none')
			{
				// nothing
			}
			elseif($load['minrequirements'] === 'amount')
			{
				if($load['minpurchase'])
				{
					// check count
					if(floatval($_factor['subtotal']) >= floatval($load['minpurchase']))
					{
						// ok
					}
					else
					{
						self::error(T_("You must have at least :val :currency in your cart to use this discount", ['val' => \dash\fit::number($load['minpurchase']), 'currency' => \lib\store::currency()]));
						return false;
					}
				}
				else
				{
					/* Bug! */
					/* We should not save such a discount code */
				}
			}
			elseif($load['minrequirements'] === 'quantity')
			{
				if($load['minquantity'])
				{
					// check count
					if(floatval($_factor['item']) >= floatval($load['minquantity']))
					{
						// ok
					}
					else
					{
						self::error(T_("You must have at least :val item in your cart to use this discount code", ['val' => \dash\fit::number($load['minquantity'])]));
						return false;
					}
				}
				else
				{
					/* Bug! */
					/* We should not save such a discount code */
				}
			}
		}

		if($load['customer'] === 'special_customer_group')
		{
			$special_group = self::load_all_dedicated($discount_id, 'special_customer_group');

			$special_group = a($special_group, 0, 'specailvalue');

			switch ($special_group)
			{
				case 'notsale':
				case 'havesale':
					// code...
					break;

				default:
					/* Bug! */
					/* We should not save such a discount code */
					break;
			}
		}
		elseif($load['customer'] === 'special_customer')
		{
			$special_customer = self::load_all_dedicated($discount_id, 'special_customer');

			if($_factor['customer'] && in_array($_factor['customer'], array_column($special_customer, 'customer_id')))
			{
				// ok
			}
			else
			{
				if(!$_factor['customer'])
				{
					self::error(T_("Please login to use this discount"));
					return false;
				}
				else
				{
					self::error(T_("Sorry! This discount code is not for you"));
					return false;
				}
			}
		}
		else
		{
			//everyone
		}

		if($load['usageperuser'])
		{
			// check not used by this user
			$count = \lib\app\discount\usage::user_usage_count($discount_id, $_factor['customer']);
			if($count)
			{
				self::error(T_("You already use from this discount code, Can not use again"));
				return false;
			}
		}


		if($load['usagetotal'])
		{
			// check maximum usage discount
			$count = \lib\app\discount\usage::total_count($discount_id);

			if(floatval($count) >= floatval($load['usagetotal']))
			{
				self::error(T_("Maximum capacity of this discount is full!"));
				return false;
			}
		}

		// base amount for calculate discount
		$base_amount = $_factor['subprice'];

		if($load['applyto'] === 'special_category')
		{
			$special_category = self::load_all_dedicated($discount_id, 'special_category');

			$product_category_ids = array_column($special_category, 'product_category_id');
			$product_category_ids = array_map('floatval', $product_category_ids);
			$product_category_ids = array_filter($product_category_ids);
			$product_category_ids = array_unique($product_category_ids);

			if($product_category_ids)
			{
				$current_products_id = array_column($_factor_detail, 'product_id');

				$get_valid_product_id = \lib\db\productcategoryusage\get::get_product_id_in_category_ids(implode(',', $current_products_id), implode(',', $product_category_ids));

				if(!$get_valid_product_id)
				{
					self::error(T_("This is a discount code for a specific category of products not found in your cart!"));
					return false;
				}

				$get_valid_product_id = array_values($get_valid_product_id);
				$get_valid_product_id = array_map('floatval', $get_valid_product_id);


				$base_amount = 0;

				foreach ($_factor_detail as $key => $value)
				{
					if(in_array($value['product_id'], $get_valid_product_id))
					{
						$base_amount += floatval($value['price']);
					}
				}
			}
			else
			{
				self::error(T_("Can not load products category!"));
				return false;

			}
		}
		elseif($load['applyto'] === 'special_products')
		{
			$special_products = self::load_all_dedicated($discount_id, 'special_products');

			$special_products_id = array_column($special_products, 'product_id');

			$finded      = false;
			$base_amount = 0;

			foreach ($_factor_detail as $key => $value)
			{
				if(in_array($value['product_id'], $special_products_id))
				{
					$finded = true;
					$base_amount += floatval($value['price']);
				}
			}

			if(!$finded)
			{
				self::error(T_("This is a discount code for a specific products not found in your cart!"));
				return false;
			}
		}
		else
		{
			/* all product */
		}



		var_dump($load);exit;
		var_dump($result);
		var_dump($discount_code);exit;

		var_dump(func_get_args());exit;
	}
}
?>