<?php
namespace lib\app\product;

class inventory
{

	public static function initial($_count, $_product_id)
	{
		$stock     = \lib\number::up($_count);
		$thisstock = $stock;

		$insert =
		[
			'inventory_id'       => null,
			'product_id'         => $_product_id,
			'datecreated'        => date("Y-m-d H:i:s"),
			'count'              => \lib\number::up($_count),
			'stock'              => $stock,
			'thisstock'          => $thisstock,
			'action'             => 'initial',
			'factor_id'          => null,
			'user_id'            => \dash\user::id(),
			'other_inventory_id' => null,
		];

		\lib\db\productinventory\insert::new_record($insert);
	}


	public static function get($_product_id)
	{
		$last_stock = \lib\db\productinventory\get::product_last_record($_product_id);
		if(isset($last_stock['stock']))
		{
			return floatval($last_stock['stock']);
		}
		else
		{
			return null;
		}

	}

	public static function manual($_count, $_product_id)
	{

		$last_stock = \lib\db\productinventory\get::product_last_record($_product_id);

		if(!$last_stock || !array_key_exists('stock', $last_stock))
		{
			return self::initial($_count, $_product_id);
		}

		$count = \lib\number::up(floatval($_count));

		$stock = floatval($last_stock['stock']);
		$diff  = floatval($count) - $stock;

		$thisstock = $stock;

		$insert =
		[
			'inventory_id'       => null,
			'product_id'         => $_product_id,
			'datecreated'        => date("Y-m-d H:i:s"),
			'manualcount'        => $count,
			'count'              => $diff,
			'stock'              => $count,
			'thisstock'          => $count,
			'action'             => 'manual',
			'factor_id'          => null,
			'user_id'            => \dash\user::id(),
			'other_inventory_id' => null,
		];

		\lib\db\productinventory\insert::new_record($insert);
	}



	public static function set($_action, $_count, $_product_id, $_factor_id = null, $_parent = null)
	{

		$stock = 0;

		switch ($_action)
		{
			case 'initial':
			case 'manual':
				// have special function
				return null;
				break;

			case 'move_to_inventory':
			case 'move_from_inventory':

			case 'warehouse_handling':
			case 'edit_sale':
			case 'buy':
			case 'edit_buy':
			case 'presell':
			case 'edit_presell':
			case 'lending':
			case 'edit_lending':
			case 'backbuy':
			case 'edit_backbuy':
			case 'backsell':
			case 'edit_backsell':
			case 'waste':
			case 'edit_waste':
			case 'saleorder':
			case 'edit_saleorder':
			case 'reject_order':
			case 'cancel_order':
			case 'expire_order':
			case 'sale':

				break;

			default:
				// invalid action
				return false;
				break;
		}

		$last_stock = \lib\db\productinventory\get::product_last_record($_product_id);

		if(!$last_stock || !array_key_exists('stock', $last_stock))
		{
			$stock = 0;
		}
		else
		{
			$stock = floatval($last_stock['stock']);
		}

		$stock = $stock + floatval($_count);

		$thisstock = $stock;

		$insert =
		[
			'inventory_id'       => null,
			'product_id'         => $_product_id,
			'datecreated'        => date("Y-m-d H:i:s"),
			'count'              => $_count,
			'stock'              => $stock,
			'thisstock'          => $thisstock,
			'action'             => $_action,
			'factor_id'          => $_factor_id,
			'parent'             => $_parent,
			'user_id'            => \dash\user::id(),
			'other_inventory_id' => null,
		];

		\lib\db\productinventory\insert::new_record($insert);

	}
}
?>