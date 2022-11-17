<?php
namespace lib\app\product;

class inventory
{

	public static function initial($_count, $_product_id)
	{
		$stock     = floatval($_count);
		$thisstock = $stock;

		$insert =
			[
				'inventory_id'       => null,
				'product_id'         => $_product_id,
				'datecreated'        => date("Y-m-d H:i:s"),
				'count'              => floatval($_count),
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


		$stock     = floatval($last_stock['stock']);
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

		$count = floatval(floatval($_count));

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


	public static function search($_query_string, $_args)
	{


		$condition =
			[
				'order'      => 'order',
				'sort'       => ['enum' => ['title', 'price', 'buyprice', 'finalprice', 'discount']],
				'limit'      => 'int',
				'product_id' => 'int',
				'pagination' => 'yes_no',
			];


		$require = [];
		$meta    = [];
		$param   = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and  = [];
		$meta = [];
		$or   = [];
		$join = [];

		if(isset($data['limit']))
		{
			$meta['limit'] = $data['limit'];
		}

		if($data['pagination'] === 'no')
		{
			$meta['pagination'] = false;
		}

		$order_sort = ' ORDER BY productinventory.id DESC ';


		if($data['product_id'])
		{
			$and[]                = " productinventory.product_id = :product_id ";
			$param[':product_id'] = $data['product_id'];
		}


		$query_string = \dash\validate::search($_query_string, false);

		if(!is_null($query_string))
		{
			// nothing yet
		}

		$list = \lib\db\productinventory\search::list($param, $and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}

		foreach ($list as $value)
		{
			$newList[] = self::ready($value);
		}

		return $newList;

	}


	private static function ready($_data)
	{

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'action':
					$result[$key] = $value;
					$result['t_action'] = self::T_Action($value);
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	private static function T_Action($_action)
	{
		$t_action =
			[
				'initial'             => T_('Initial'),
				'manual'              => T_('Manual'),
				'presell'             => T_('Presell'),
				'edit_presell'        => T_('Edit presell'),
				'lending'             => T_('Lending'),
				'edit_lending'        => T_('Edit lending'),
				'backbuy'             => T_('Backbuy'),
				'edit_backbuy'        => T_('Edit backbuy'),
				'waste'               => T_('Waste'),
				'edit_waste'          => T_('Edit waste'),
				'saleorder'           => T_('Saleorder'),
				'edit_saleorder'      => T_('Edit saleorder'),
				'move_from_inventory' => T_('Move from inventory'),
				'sale'                => T_('Sale'),
				'edit_sale'           => T_('Edit sale'),
				'move_to_inventory'   => T_('Move to inventory'),
				'warehouse_handling'  => T_('Warehouse handling'),
				'buy'                 => T_('Buy'),
				'edit_buy'            => T_('Edit buy'),
				'backsell'            => T_('Backsell'),
				'edit_backsell'       => T_('Edit backsell'),
				'reject_order'        => T_('Reject order'),
				'cancel_order'        => T_('Cancel order'),
				'expire_order'        => T_('Expire order'),
				'deleted_order'       => T_('Deleted order'),
			];


		if(isset($t_action[$_action]))
		{
			return $t_action[$_action];
		}

		return $_action;
	}

}
