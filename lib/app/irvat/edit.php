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

		$get_irvat = \lib\db\irvats\get::one($_id);

		if(isset($get_irvat['id']) && isset($get_irvat['title']) && $get_irvat['title'] == $args['title'])
		{
			if(floatval($get_irvat['id']) === floatval($_id))
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Duplicate irvat founded"), 'irvat');
				return false;
			}
		}


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
				$update = \lib\db\irvats\update::record($args, $_id);

				if($update)
				{

					\dash\log::set('FundUpdated', ['old' => $get_irvat, 'change' => $args]);
					\dash\notif::ok(T_("The irvat successfully updated"));
					return true;
				}
				else
				{
					\dash\log::set('irvatsDbCannotUpdate');
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