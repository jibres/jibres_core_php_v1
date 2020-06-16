<?php
namespace lib\app\fund;


class edit
{


	public static function edit($_args, $_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid fund id"));
			return false;
		}

		$args = \lib\app\fund\check::variable($_args, $_id);

		if(!$args)
		{
			return false;
		}

		$get_fund = \lib\db\funds\get::one($_id);

		if(isset($get_fund['id']) && isset($get_fund['title']) && $get_fund['title'] == $args['title'])
		{
			if(floatval($get_fund['id']) === floatval($_id))
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Duplicate fund founded"), 'fund');
				return false;
			}
		}


		if(!empty($args))
		{
			foreach ($get_fund as $field => $value)
			{
				if(array_key_exists($field, $args) && $args[$field] == $value)
				{
					unset($args[$field]);
				}
			}

			if(empty($args))
			{
				\dash\notif::info(T_("No change in your fund"));
				return null;
			}
			else
			{
				$update = \lib\db\funds\update::record($args, $_id);

				if($update)
				{

					\dash\log::set('FundUpdated', ['old' => $get_fund, 'change' => $args]);
					\dash\notif::ok(T_("The fund successfully updated"));
					return true;
				}
				else
				{
					\dash\log::set('fundsDbCannotUpdate');
					\dash\notif::error(T_("Can not update your fund"));
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