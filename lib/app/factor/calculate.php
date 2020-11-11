<?php
namespace lib\app\factor;


class calculate
{

	public static function again($_factor_id)
	{
		$load_factor = \lib\app\factor\get::one($_factor_id);
		if(!$load_factor)
		{
			return false;
		}

		// calculate sum factor
		$get_sum_detail = \lib\db\factordetails\get::sum_detail($_factor_id);

		if(!is_array($get_sum_detail))
		{
			$get_sum_detail = [];
		}

		$factor                = [];

		if(array_key_exists('subprice', $get_sum_detail))
		{
			$factor['subprice']    = $get_sum_detail['subprice'];
			$factor['subdiscount'] = $get_sum_detail['subdiscount'];
			$factor['subvat']      = $get_sum_detail['subvat'];
			$factor['subtotal']    = $get_sum_detail['subtotal'];
			$factor['qty']         = $get_sum_detail['qty'];
			$factor['item']        = $get_sum_detail['item'];
		}
		else
		{
			// factor is empty
			$factor['subprice']    = 0;
			$factor['subdiscount'] = 0;
			$factor['subvat']      = 0;
			$factor['subtotal']    = 0;
			$factor['qty']         = 0;
			$factor['item']        = 0;
		}

		$factor['discount']    = $load_factor['discount'];

		$factor_total = floatval($factor['subtotal']) - floatval($factor['discount']);

		if($factor['discount'])
		{
			if(floatval($factor['discount']) > floatval($factor['subtotal']))
			{
				\dash\notif::error(T_("Discount is larger than order total"));
				return false;
			}
		}

		if($load_factor['mode'] === 'customer')
		{

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


		$update = \lib\db\factors\update::record($factor, $_factor_id);

		return $update;

	}
}
?>