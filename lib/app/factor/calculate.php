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
			else
			{
				$factor['shipping'] = 0;
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

		// calculate product inventory
		$product_neet_track_count = \lib\db\factordetails\get::product_neet_track_count($_factor_id);
		if(!is_array($product_neet_track_count))
		{
			$product_neet_track_count = [];
		}

		if(!$product_neet_track_count)
		{
			// no product in this factor need to track quantity
			// need to check if this factor have anry inventory record
			// if exist need to remove it and re calculate product inventory
			$old_inventory_record = \lib\db\productinventory\get::by_factor_id($_factor_id);
			if(!is_array($old_inventory_record))
			{
				$old_inventory_record = [];
			}

			foreach ($old_inventory_record as $key => $value)
			{
				\lib\db\productinventory\delete::record($value['id']);

				\lib\app\product\inventory::refresh($value['product_id'], $_factor_id);

				$get_stock = \lib\app\product\inventory::get($value['product_id']);

				if(!is_null($get_stock))
				{
					if($get_stock <= 0)
					{
						\lib\app\product\edit::out_of_stock($value['product_id']);
					}
				}
			}
		}

		$allow_action_type =
		[
			'move_to_inventory',	'move_from_inventory',	'warehouse_handling',		'edit_sale',
			'buy',					'edit_buy',				'presell',					'edit_presell',
			'lending',				'edit_lending',			'backbuy',					'edit_backbuy',
			'backsell',				'edit_backsell',		'waste',					'edit_waste',
			'saleorder',			'edit_saleorder',		'reject_order',				'cancel_order',
			'expire_order',			'deleted_order',		'sale',
		];

		foreach ($product_neet_track_count as $key => $value)
		{
			\lib\db\productinventory\delete::by_factor_id_product_id($_factor_id, $value['product_id']);

			$action_type = 'edit_'. $load_factor['type'];
			if(!in_array($action_type, $allow_action_type))
			{
				\dash\log::set('invalidFactorType');
				$action_type = 'edit_saleorder';
			}

			\lib\app\product\inventory::set($action_type, $value['count'], $value['product_id'], $_factor_id);

			$get_stock = \lib\app\product\inventory::get($value['product_id']);

			if(!is_null($get_stock))
			{
				if($get_stock <= 0)
				{
					\lib\app\product\edit::out_of_stock($value['product_id']);
				}
			}
		}

		return true;
	}
}
?>