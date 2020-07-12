<?php
namespace lib\app\irvat;


class edit
{


	public static function edit($_args, $_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid irvat id"));
			return false;
		}

		$args = \lib\app\irvat\check::variable($_args, $_id);

		if(!$args)
		{
			return false;
		}

		if(isset($args['seller']) && $args['seller'] && !array_key_exists('seller', $_args))
		{
			$_args['seller'] = $args['seller'];
		}

		if(isset($args['customer']) && $args['customer'] && !array_key_exists('customer', $_args))
		{
			$_args['customer'] = $args['customer'];
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		$get_irvat = \lib\db\irvat\get::one($_id);


		if(!empty($args))
		{
			foreach ($get_irvat as $field => $value)
			{
				if(array_key_exists($field, $args) && $args[$field] == $value)
				{
					unset($args[$field]);
				}
			}

			if(empty($args))
			{
				\dash\notif::info(T_("No change in your irvat"));
				return null;
			}
			else
			{
				$update = \lib\db\irvat\update::record($args, $_id);

				if($update)
				{

					\dash\notif::ok(T_("The irvat successfully updated"));
					return true;
				}
				else
				{
					\dash\notif::error(T_("Can not update your irvat"));
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