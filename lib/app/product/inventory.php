<?php
namespace lib\app\product;

class inventory
{

	public static function initial($_count, $_product_id)
	{
		return;
		$stock     = $_count;
		$thisstock = $stock;

		$insert =
		[
			'inventory_id'       => null,
			'product_id'         => $_product_id,
			'datecreated'        => date("Y-m-d H:i:s"),
			'count'              => $_count,
			'stock'              => $stock,
			'thisstock'          => $thisstock,
			'action'             => 'initial',
			'factor_id'          => null,
			'user_id'            => \dash\user::id(),
			'other_inventory_id' => null,
		];

		\lib\db\productinventory\insert::new_record($insert);
	}


	public static function manual($_count, $_product_id)
	{
		return;
		$last_stock = \lib\db\productinventory\get::product_last_record($_product_id);

		var_dump($last_stock);exit();


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
			'factor_id'          => null,
			'user_id'            => \dash\user::id(),
			'other_inventory_id' => null,
		];

		\lib\db\productinventory\insert::new_record($insert);
	}

	public static function set($_action, $_count, $_product_id)
	{
		// 'initial','manual','move_to_inventory','move_from_inventory','warehouse_handling','sale','edit_sale','buy','edit_buy','presell','edit_presell','lending','edit_lending','backbuy','edit_backbuy','backsell','edit_backsell','waste','edit_waste','saleorder''edit_saleorder''reject_order','cancel_order'

		$stock = null;
		if($_action === 'initial')
		{
			$stock = $_count;
		}
		elseif($_action === 'manual')
		{
			$stock = null;
		}

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
			'factor_id'          => null,
			'user_id'            => \dash\user::id(),
			'other_inventory_id' => null,
		];

		\lib\db\productinventory\insert::new_record($insert);

	}
}
?>