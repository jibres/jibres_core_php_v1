<?php
namespace lib\app\discount;


class discount_check
{
	private static $result             = [];
	private static $load_all_dedicated = false;
	private static $user_id            = null;
	private static $code               = null;
	private static $discount_id        = null;
	private static $valid              = null;
	private static $edit_factor_mode   = false;


	public static function get_result()
	{
		self::$result = [];

		// first check and fill $result
		self::check(...func_get_args());

		return self::$result;
	}


	/**
	 * Gets the result by discount identifier.
	 * Not check status or active discount
	 * Only check price and minimum requirement
	 * In edit factor load this function
	 *
	 * @param      <type>  $_discount_code  The discount code
	 * @param      <type>  $_factor         The factor
	 * @param      <type>  $_factor_detail  The factor detail
	 */
	public static function get_result_by_discount_id($_discount_id, $_factor, $_factor_detail)
	{
		self::$edit_factor_mode = true;
		self::$discount_id      = $_discount_id;

		self::$result           = [];

		self::check(null, $_factor, $_factor_detail);

		return self::$result;
	}


	/**
	 * Saves a lookup.
	 *
	 * @param      <type>  $_error_type  The error type
	 * @param      <type>  $_error_msg   The error message
	 */
	private static function save_lookup($_error_message = null, $_ciritical = null)
	{
		$insert                = [];
		$insert['user_id']     = self::$user_id;
		$insert['code']        = self::$code;
		$insert['discount_id'] = self::$discount_id;
		$insert['valid']       = self::$valid ? 'yes' : 'no';
		$insert['errortype']   = null;
		$insert['message']     = $_error_message;
		$insert['datecreated'] = date("Y-m-d H:i:s");
		$insert['ip_id']       = \dash\utility\ip::id();
		$insert['agent_id']    = \dash\agent::get(true);

		\lib\db\discount_lookup\insert::new_record($insert);

		if($_ciritical)
		{
			$get_count_invalid_lookup = \lib\db\discount_lookup\get::count_by_ip_agent($insert['ip_id'], $insert['agent_id']);

			if($get_count_invalid_lookup > 10)
			{
				\dash\waf\ip::isolateIP(1, 'invalid_discount_code > 10');
			}
			elseif($get_count_invalid_lookup > 50)
			{
				\dash\waf\ip::isolateIP(10, 'invalid_discount_code > 50');
			}
		}
	}


	/**
	 * Save error in msg variable
	 *
	 * @param      <type>  $_msg   The message
	 * @param      string  $_mode  The mode
	 */
	private static function error($_msg, $_ciritical = null)
	{
		self::save_lookup($_msg, $_ciritical);

		self::$result['msg_class'] = 'alert-danger p-2 rounded-lg';
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
		// needless to chekc anything.
		if(!$_factor['subtotal'])
		{
			self::error(T_("No amount to pay!"));
			return false;
		}


		// save current user id
		if($_factor['customer'])
		{
			self::$user_id = $_factor['customer'];
		}
		elseif(\dash\user::id())
		{
			self::$user_id = \dash\user::id();
		}

		if(self::$edit_factor_mode && self::$discount_id)
		{
			// not check discount code
			$load = \lib\app\discount\get::get(self::$discount_id);
		}
		else
		{
			// save discount code
			self::$code = \dash\validate::string($_discount_code, false);
			if(mb_strlen(self::$code) > 100)
			{
				self::$code = substr(self::$code, 0, 100);
			}


			/*----------  validate discount string code  ----------*/
			$discount_code = \dash\validate::discount_code($_discount_code, false);

			if(!$discount_code)
			{
				self::error(T_("Invalid Discount code"), true);
				return false;
			}

			/*----------  load discount code  ----------*/
			$load = \lib\app\discount\get::by_code($discount_code);

		}

		if(!$load)
		{
			self::error(T_("Discount not found"), true);
			return false;
		}

		// save is valid discoutn
		self::$valid = true;


		// save discount id
		self::$discount_id = $discount_id = $load['id'];

		// in edit mode needless to check something
		if(!self::$edit_factor_mode)
		{
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

			if(!$_factor['customer'])
			{
				self::error(T_("Please login to use this discount"));
				return false;
			}

			$count_factors_by_this_customer = \lib\db\factors\get::count_by_customer($_factor['customer']);

			switch ($special_group)
			{
				case 'notsale':
					if($count_factors_by_this_customer)
					{
						// the user was sale before
						self::error(T_("Discount only for first order!"));
						return false;
					}
					break;

				case 'havesale':
					if(!$count_factors_by_this_customer)
					{
						// the user was sale before
						self::error(T_("Discount only for customer who have order before!"));
						return false;
					}
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

		if(!self::$edit_factor_mode)
		{
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
		}

		/*=============================================
		=            Define somve variable            =
		=============================================*/

		// base amount for calculate discount
		$base_amount = $_factor['subprice'];

		// Which products are assigned to the discount code
		$apply_product_ids = [];

		// The amount to be subtracted from the sum
		$discount2 = 0;

		// free shipping
		$free_shipping = false;

		/*=====  End of Define somve variable  ======*/


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
						$apply_product_ids[] = $value['product_id'];
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
					$apply_product_ids[] = $value['product_id'];
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
			$apply_product_ids = array_column($_factor_detail, 'product_id');
		}

		if($load['type'] === 'percentage')
		{
			if($load['percentage'])
			{
				$discount2 = self::percentage($base_amount, $load['percentage']);

				// check maximum amount
				if(floatval($load['maxamount']))
				{
					if(floatval($discount2) > floatval($load['maxamount']))
					{
						$discount2 = $load['maxamount'];
					}
				}
			}
			else
			{
				/* Bug! */
				self::error(T_("Discount is broken!"));
				return false;

			}
		}
		elseif($load['type'] === 'fixed_amount')
		{
			if($load['fixedamount'])
			{
				$discount2 = floatval($load['fixedamount']);
			}
			else
			{
				/* Bug! */
				self::error(T_("Discount is broken!"));
				return false;
			}
		}
		elseif($load['type'] === 'free_shipping')
		{
			$free_shipping = true;
		}
		else
		{
			/* Bug! */
			self::error(T_("Invalid discount code type!"));
			return false;
		}


		/**
		 * @example
		 * subtotal = 100
		 * discount2 = 120
		 * discount2 = 120 - |100 - 120|
		 * discount2 = 100
		 */
		if(floatval($_factor['subtotal']) - floatval($discount2) < 0)
		{
			$discount2 = $discount2 - abs(floatval($_factor['subtotal']) - floatval($discount2));
		}


		/*----------  Calculate discount per products  ----------*/
		$discount_per_product = $discount2 / count($apply_product_ids);

		$product_discount = [];

		foreach ($apply_product_ids as $product_id)
		{
			$product_discount[$product_id] = $discount_per_product;
		}

		/*===============================================
		=            Save setting in $result            =
		===============================================*/

		self::$result['discount2']        = $discount2;
		self::$result['free_shipping']    = $free_shipping;
		self::$result['discount_id']      = $discount_id;
		self::$result['product_discount'] = $product_discount;
		self::$result['success_msg']      = T_("here you are :) ");



		self::$result['msg_class'] = 'alert-success p-2 rounded-lg';
		if(a($load, 'msgsuccess'))
		{
			self::$result['msg']       = $load['msgsuccess'];

		}
		else
		{
			self::$result['msg']       = T_("Discount code applied");
		}

		self::save_lookup(T_("Ok"));

		return true;

	}


	/**
	 * Calculate percentage
	 * 20% of 500 => (20 * 500) / 100
	 *
	 * @param      <type>  $_amount      The amount
	 * @param      <type>  $_percentage  The percentage
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function percentage($_amount, $_percentage)
	{
		return ((floatval($_amount) * floatval($_percentage)) / 100);
	}
}
?>