<?php
namespace lib\app\factor;


class discount_check
{
	private static $result = [];


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
					/* Bug */
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
					/* Bug */
					/* We should not save such a discount code */
				}
			}
		}

		if($load['customer'] === 'special_customer_group')
		{

		}
		elseif($load['customer'] === 'special_customer')
		{

		}
		else
		{
			//everyone
		}


		var_dump($load);exit;
		var_dump($result);
		var_dump($discount_code);exit;

		var_dump(func_get_args());exit;
	}
}
?>