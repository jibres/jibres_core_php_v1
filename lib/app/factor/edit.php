<?php
namespace lib\app\factor;


class edit
{
	public static function refresh_detail_record($_id)
	{
		$load_record = \lib\db\factordetails\get::by_id($_id);

		if(!isset($load_record['id']))
		{
			return false;
		}

		// 'price' => string '650000' (length=6)
		// 'discount' => string '150000' (length=6)
		// 'vat' => string '0' (length=1)
		// 'finalprice' => string '500000' (length=6)
		// 'count' => string '8000' (length=4)
		// 'sum' => string '2500000000' (length=10)

		$update        = [];
		$update['sum'] = floatval($load_record['finalprice']) * floatval($load_record['count']);

		\lib\db\factordetails\update::record($update, $_id);

	}


	public static function edit_count_product($_id, $_factor_id, $_type, $_count)
	{
		$id        = \dash\validate::id($_id);
		$factor_id = \dash\validate::id($_factor_id);
		$count     = \dash\validate::int($_count);
		$count     = \lib\number::up($count);

		if(!$id || !$factor_id)
		{
			\dash\notif::error(T_("Id is required"));
			return false;
		}

		$check_ok  = \lib\db\factordetails\get::by_id_factor_id($id, $factor_id);

		if(!isset($check_ok['id']))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		// if(isset($check_ok['status']) && $check_ok['status'] === 'deleted')
		// {
		// 	\dash\notif::error(T_("Item not found"));
		// 	return false;
		// }
		\dash\db::transaction();

		$current_count = floatval(\dash\get::index($check_ok, 'count'));

		switch ($_type)
		{
			case 'edit_count':
				$new_count = $count;
				break;

			case 'plus_count':
				$new_count = $current_count + $count;
				break;

			case 'minus_count':
				$new_count = $current_count - $count;
				break;

			case 'remove':
				\lib\db\factordetails\delete::record($id);
				\lib\app\factor\calculate::again($factor_id);
				\dash\notif::ok(T_("Item removed"));
				\dash\db::commit();
				return true;

				break;

			default:
				\dash\notif::error(T_("Invalid type"));
				\dash\db::rollback();
				return false;
				break;
		}

		if($new_count < 1)
		{
			\dash\notif::error(T_("Can not set count product in factor less than 1"));
			return false;
		}

		\lib\db\factordetails\update::record(['count' => $new_count], $id);

		\lib\app\factor\edit::refresh_detail_record($id);

		\lib\app\factor\calculate::again($factor_id);

		\dash\db::commit();

		\dash\notif::ok(T_("Data saved"));
		return true;
	}



	public static function auto_expire_order()
	{
		$order_setting = \lib\app\setting\get::order_setting();

		if(isset($order_setting['life_time']) && is_numeric($order_setting['life_time']))
		{
			$life_time = floatval($order_setting['life_time']);
			if($life_time > 0)
			{
				$expire_time = date("Y-m-d H:i:s", time() - $life_time);

				$auto_expire_order_list = \lib\db\factors\search::auto_expire_order($expire_time);
				if($auto_expire_order_list)
				{
					foreach ($auto_expire_order_list as $key => $value)
					{
						\lib\app\factor\action::add(['action' => 'expire'], $value['id']);

						$check_have_stock_record = \lib\db\productinventory\get::by_factor_id($value['id']);

						if($check_have_stock_record && is_array($check_have_stock_record))
						{
							foreach ($check_have_stock_record as $key => $value)
							{
								\lib\app\product\inventory::set('expire_order', $value['count'], $value['product_id'], null, $value['id']);
								$get_stock = \lib\app\product\inventory::get($value['product_id']);
								if(!is_null($get_stock))
								{
									if($get_stock > 0)
									{
										\lib\app\product\edit::in_stock($value['product_id']);
									}
								}
							}
						}
					}
				}
			}
		}
	}


	public static function user_cancel($_id)
	{
		$load_factor = \lib\app\factor\get::one($_id);

		if(!$load_factor)
		{
			return false;
		}

		if(array_key_exists('pay', $load_factor) && !$load_factor['pay'])
		{
			// no proble
		}
		else
		{
			\dash\notif::error(T_("This factor is payed. To cancel this order contact to administrator"));
			return false;
		}


		\lib\app\factor\action::add(['action' => 'cancel'], $load_factor['id']);

		$check_have_stock_record = \lib\db\productinventory\get::by_factor_id($load_factor['id']);

		if($check_have_stock_record && is_array($check_have_stock_record))
		{
			foreach ($check_have_stock_record as $key => $value)
			{
				\lib\app\product\inventory::set('cancel_order', $value['count'], $value['product_id'], null, $value['id']);
				$get_stock = \lib\app\product\inventory::get($value['product_id']);
				if(!is_null($get_stock))
				{
					if($get_stock > 0)
					{
						\lib\app\product\edit::in_stock($value['product_id']);
					}
				}
			}
		}
	}




	public static function status($_status, $_factor_id)
	{
		$factor_id = \lib\app\factor\get::fix_id($_factor_id);

		if(!$_status || !$factor_id)
		{
			return false;
		}

		$update =
		[
			'status'       => $_status,
			'datemodified' => date("Y-m-d H:i:s")
		];

		return \lib\db\factors\update::record($update, $factor_id);
	}

	public static function type($_type, $_factor_id)
	{
		$factor_id = \lib\app\factor\get::fix_id($_factor_id);

		if(!$_type || !$factor_id)
		{
			return false;
		}

		$update =
		[
			'type'       => $_type,
			'datemodified' => date("Y-m-d H:i:s")
		];

		return \lib\db\factors\update::record($update, $factor_id);
	}


	public static function edit_factor($_args, $_id)
	{
		$load_factor = \lib\app\factor\get::one($_id);

		if(!$load_factor)
		{
			return false;
		}

		$args = \lib\app\factor\check::factor($_args, ['factor_detail' => $load_factor]);

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(empty($args))
		{
			\dash\notif::info(T_("Order save without change"));
			return true;
		}
		else
		{
			\lib\db\factors\update::record($args, $load_factor['id']);
			\dash\notif::ok(T_("Order updated"));
			return true;
		}
	}


	public static function edit_address($_args, $_factor_id)
	{
		$load_factor = \lib\app\factor\get::one($_factor_id);

		if(!$load_factor)
		{
			return false;
		}

		$condition =
		[
			'name'        => 'displayname',
			'mobile'      => 'mobile',
			'company'     => 'bit',
			'country'     => 'country',
			'province'    => 'province',
			'city'        => 'city',
			'address'     => 'address',
			'address2'    => 'address',
			'postcode'    => 'postcode',
			'phone'       => 'phone',
			'fax'         => 'phone',
		];

		$require = [];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		\lib\db\factoraddress\update::record($data, $load_factor['id']);

		\dash\notif::ok(T_("Order address was updated"));

		return true;
	}


	/**
	 * edit a factor
	 *
	 * @param      <type>   $_factor  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function edit($_id, $_factor, $_factor_detail, $_option = [])
	{
		\dash\notif::errot('Not ready');
		return;

		// $default_option =
		// [
		// 	'debug' => true,
		// ];

		// if(!is_array($_option))
		// {
		// 	$_option = [];
		// }

		// $_option = array_merge($default_option, $_option);


		// $id = \dash\coding::decode($_id);

		// if(!$id || !is_numeric($id))
		// {
		// 	if($_option['debug']) \dash\notif::error(T_("Id not set"));
		// 	return false;
		// }

		// if(!\lib\store::id())
		// {
		// 	if($_option['debug']) \dash\notif::error(T_("Id not set"));
		// 	return false;
		// }

		// if(!\lib\store::in_store())
		// {
		// 	\dash\notif::error(T_("You are not in this store"));
		// 	return false;
		// }

		// $load_factor = \lib\db\factors::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		// if(empty($load_factor) || !$load_factor || !isset($load_factor['id']))
		// {
		// 	if($_option['debug']) \dash\notif::error(T_("Can not access to edit it"), 'factor', 'permission');
		// 	return false;
		// }

		// \lib\db\factordetails::remove_factor($load_factor['id']);

		// $return = \lib\app\factor::add($_factor, $_factor_detail, ['factor_id' => $load_factor['id'], 'debug' => false]);

		// if(\dash\engine\process::status())
		// {
		// 	\dash\notif::ok(T_("Your factor successfully updated"));
		// }

		// return $return;
	}
}
?>
