<?php
namespace lib\app\factor;


class shipping
{

	/**
	 * Gets the shipping price.
	 *
	 * @param      <type>  $_total  The total
	 *
	 * @return     int     The shipping price.
	 */
	public static function get_shipping_price($_total)
	{
		$shipping_value = 0;

		$shipping = \lib\app\setting\get::shipping_setting();

		if(isset($shipping['sendbypost']) && $shipping['sendbypost'] && isset($shipping['sendbypostprice']) && $shipping['sendbypostprice'])
		{
			if(isset($shipping['freeshipping']) && $shipping['freeshipping'] && isset($shipping['freeshippingprice']) && $shipping['freeshippingprice'])
			{
				if(floatval($_total) >= floatval($shipping['freeshippingprice']))
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

		return $shipping_value;
	}


	/**
	 * Calculates the shipping value.
	 * if file mode have not shipping value
	 *
	 * @param      <type>  $factor   The factor
	 * @param      array   $_option  The option
	 *
	 * @return     <type>  The shipping value.
	 */
	public static function calculate_shipping_value($factor, $_option = [])
	{
		// in file mode not calculate shipping
		if(isset($_option['fileMode']) && $_option['fileMode'])
		{
			return $factor;
		}

		$shippingSetting = \lib\app\setting\get::shipping_setting();

		if(isset($shippingSetting['shipping_status']) && $shippingSetting['shipping_status'])
		{
			// ok
		}
		else
		{
			return  $factor;
		}

		// shipping_status


		$shipping_value = 0;

		if(isset($_option['shipping_value']) &&  is_numeric($_option['shipping_value']))
		{
			$shipping_value = floatval($_option['shipping_value']);
			$factor['shipping'] = $shipping_value;
		}
		else
		{
			if(a($_option, 'mode') === 'customer')
			{
				$shipping_value = self::get_shipping_price($factor['total']);
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
}
?>