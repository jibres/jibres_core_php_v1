<?php
namespace lib\app\factor;


class calculate
{

	public static function again($_factor_id, $_option = [])
	{
		$load_factor = \lib\app\factor\get::one($_factor_id);
		if(!$load_factor)
		{
			return false;
		}

		$ready_factor =
		[
			'desc'       => a($load_factor, 'desc'),
			'discount'   => a($load_factor, 'discount'),
			'shipping'   => a($load_factor, 'shipping'),
			'date'       => a($load_factor, 'date'),
			'type'       => a($load_factor, 'type'),
			'status'     => a($load_factor, 'status'),
			'paystatus'  => a($load_factor, 'paystatus'),
			'customer'   => a($load_factor, 'customer'),
			'guestid'    => a($load_factor, 'guestid'),
			'address_id' => a($load_factor, 'address_id'),
		];

		$factor_detail = \lib\db\factordetails\get::by_factor_id_join_product($_factor_id);

		if(!is_array($factor_detail))
		{
			$factor_detail = [];
		}

		$ready_factor_detail = [];

		foreach ($factor_detail as $key => $value)
		{
			$ready_factor_detail[] =
			[
				'product'  => a($value, 'product_id'),
				'count'    => a($value, 'count'),
				'discount' => a($value, 'discount'),
				'price'    => a($value, 'price'),
			];
		}

		$factor_option =
		[
			'customer_mode'       => (a($load_factor, 'mode') === 'customer') ? true : false,
			'factor_id'           => $_factor_id,
			're_calculate_factor' => true,
			'discount_id'         => a($load_factor, 'discount_id'),
		];

		$result = \lib\app\factor\add::new_factor($ready_factor, $ready_factor_detail, $factor_option);

		// we have error in data
		if(!\dash\engine\process::status())
		{
			return false;
		}

		if(isset($_option['show_discount_error']))
		{
			if(isset($result['discount_code']['msg']))
			{
				\dash\notif::error($result['discount_code']['msg']);
			}
		}

		// update factor record
		$update = \lib\db\factors\update::record($result['factor'], $_factor_id);

		// remove all current factor detail
		\lib\db\factordetails\delete::hard_by_factor_id($_factor_id);

		$product_discount = [];
		if(is_array(a($result, 'discount_code', 'product_discount')))
		{
			$product_discount = $result['discount_code']['product_discount'];
		}

		$factor_detail = $result['factor_detail'];

		foreach ($factor_detail as $key => $value)
		{
			$factor_detail[$key]['factor_id'] = $_factor_id;
			unset($factor_detail[$key]['sub_price_temp']);
			unset($factor_detail[$key]['sub_discount_temp']);
			unset($factor_detail[$key]['sub_vat_temp']);
			unset($factor_detail[$key]['type']);

			// save product discount
			if(isset($product_discount[$value['product_id']]))
			{
				$factor_detail[$key]['discount2'] = $product_discount[$value['product_id']];

			}

			unset($factor_detail[$key]['track_stock_temp']);

		}

		$add_detail = \lib\db\factordetails\insert::multi_insert($factor_detail);




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