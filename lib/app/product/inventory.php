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

		if($_count > 0)
		{
			\lib\app\product\edit::in_stock($_product_id);
		}
		else
		{
			\lib\app\product\edit::out_of_stock($_product_id);
		}
	}


	public static function get($_product_id)
	{
		$last_stock = \lib\db\productinventory\get::sum_stock($_product_id);
		if(isset($last_stock['stock']))
		{
			return floatval($last_stock['stock']);
		}
		else
		{
			return null;
		}
	}


	public static function refresh($_product_id, $_factor_id = null)
	{
		$last_stock = \lib\db\productinventory\get::sum_stock($_product_id);

		if(!$last_stock || !array_key_exists('stock', $last_stock))
		{
			return false;
		}


		$stock = floatval($last_stock['stock']);
		$thisstock = $stock;

		$insert =
		[
			'inventory_id'       => null,
			'product_id'         => $_product_id,
			'datecreated'        => date("Y-m-d H:i:s"),
			'manualcount'        => null,
			'count'              => null,
			'stock'              => $stock,
			'thisstock'          => $stock,
			'action'             => 'refresh',
			'factor_id'          => $_factor_id,
			'user_id'            => \dash\user::id(),
			'other_inventory_id' => null,
		];

		\lib\db\productinventory\insert::new_record($insert);

		if($stock > 0)
		{
			\lib\app\product\edit::in_stock($_product_id);
		}
		else
		{
			\lib\app\product\edit::out_of_stock($_product_id);
		}

	}

	public static function manual($_count, $_product_id)
	{

		$last_stock = \lib\db\productinventory\get::sum_stock($_product_id);

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

		if($count > 0)
		{
			\lib\app\product\edit::in_stock($_product_id);
		}
		else
		{
			\lib\app\product\edit::out_of_stock($_product_id);
		}
	}



	public static function set($_action, $_count, $_product_id, $_factor_id = null, $_parent = null)
	{

		$count = abs(floatval($_count));

		$stock = 0;

		switch ($_action)
		{
			case 'initial':
			case 'manual':
				// have special function
				return null;
				break;

			/* --------------------------------------- like sale must be minus stock ------------------------------*/

			case 'presell':
			case 'edit_presell':
			case 'lending':
			case 'edit_lending':

			case 'backbuy':
			case 'edit_backbuy':

			case 'waste':
			case 'edit_waste':

			case 'saleorder':
			case 'edit_saleorder':

			case 'move_from_inventory':

			case 'sale':
			case 'edit_sale':
				$count = $count * -1;
				break;


			/* --------------------------------------- like buy must be plus stock ------------------------------*/
			case 'move_to_inventory':

			case 'warehouse_handling':

			case 'buy':
			case 'edit_buy':

			case 'backsell':
			case 'edit_backsell':

			case 'reject_order':
			case 'cancel_order':
			case 'expire_order':
			case 'deleted_order':
				$count = $count; // no change
				break;

			default:
				// invalid action
				return false;
				break;
		}

		$last_stock = \lib\db\productinventory\get::sum_stock($_product_id);

		if(!$last_stock || !array_key_exists('stock', $last_stock))
		{
			$stock = 0;
		}
		else
		{
			$stock = floatval($last_stock['stock']);
		}

		$stock = $stock + floatval($count);

		$thisstock = $stock;

		$insert =
		[
			'inventory_id'       => null,
			'product_id'         => $_product_id,
			'datecreated'        => date("Y-m-d H:i:s"),
			'count'              => $count,
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