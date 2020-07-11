<?php
namespace lib\app\inventory;


class edit
{


	public static function edit($_args, $_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid inventory id"));
			return false;
		}

		$args = \lib\app\inventory\check::variable($_args, $_id);

		if(!$args)
		{
			return false;
		}


		$check_duplicate = \lib\db\inventory\get::check_duplicate($args['name']);

		if(isset($check_duplicate['id']))
		{
			if(floatval($check_duplicate['id']) === floatval($_id))
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Duplicate inventory name"));
				return false;
			}
		}


		$args = \dash\cleanse::patch_mode($_args, $args);

		$get_inventory = \lib\db\inventory\get::one($_id);


		if(!empty($args))
		{
			foreach ($get_inventory as $field => $value)
			{
				if(array_key_exists($field, $args) && $args[$field] == $value)
				{
					unset($args[$field]);
				}
			}

			if(empty($args))
			{
				\dash\notif::info(T_("No change in your inventory"));
				return null;
			}
			else
			{
				$update = \lib\db\inventory\update::record($args, $_id);

				if($update)
				{

					\dash\notif::ok(T_("The inventory successfully updated"));
					return true;
				}
				else
				{
					\dash\notif::error(T_("Can not update your inventory"));
					return false;
				}
			}
		}
		else
		{
			\dash\notif::info(T_("Fund saved without chnage"));
			return false;
		}
	}


}
?>