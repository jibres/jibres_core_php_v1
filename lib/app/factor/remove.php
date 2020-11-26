<?php
namespace lib\app\factor;


class remove
{
	public static function remove($_id)
	{
		$load_detail = \lib\app\factor\get::by_id($_id);
		if(!$load_detail || !isset($load_detail['status']))
		{
			return false;
		}

		\lib\app\factor\check::permission_order_manage($load_detail, false);

		if($load_detail['status'] === 'deleted')
		{
			\dash\notif::error(T_("This order was deleted before"));
			return false;
		}
		else
		{
			\dash\db::transaction();

			$deleted = \lib\db\factors\update::record(['status' => 'deleted'], $load_detail['id']);
			if($deleted)
			{
				$update_record = \lib\db\factordetails\delete::by_factor_id($load_detail['id']);

				if($update_record)
				{
					$have_inventory = \lib\db\productinventory\get::by_factor_id($load_detail['id']);

					if($have_inventory && is_array($have_inventory))
					{
						foreach ($have_inventory as $key => $value)
						{
							if(isset($value['product_id']) && isset($value['count']))
							{
								\lib\app\product\inventory::set('deleted_order', $value['count'], $value['product_id'], $load_detail['id']);
								\lib\app\product\edit::in_stock($value['product_id']);
							}
						}
					}

					\dash\db::commit();
				}
				else
				{
					\dash\db::rollback();
					\dash\notif::ok(T_("Error in delete order. Please contact to administrator"));
					return false;
				}
			}
			else
			{
				\dash\db::rollback();
				\dash\notif::ok(T_("Error in delete order. Please contact to administrator"));
				return false;
			}


			\dash\notif::ok(T_("Order was deleted"));
			return true;
		}

	}
}
?>