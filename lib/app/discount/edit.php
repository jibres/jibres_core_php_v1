<?php
namespace lib\app\discount;


class edit
{

	public static function edit($_args, $_id)
	{
		$load = \lib\app\discount\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$args = \lib\app\discount\check::variable($_args, $_id);

		if(!$args)
		{
			return false;
		}


		$data = \dash\cleanse::patch_mode($_args, $args);



		$check_duplicate_code = \lib\db\discount\get::check_duplicate_code($args['code']);

		if(isset($check_duplicate_code['id']))
		{
			if(floatval($check_duplicate_code['id']) === floatval($load['id']))
			{
				// ok. nothing
			}
			else
			{
				\dash\notif::error(T_("This discount code is exist in your list. Try another"));
				return false;
			}
		}


		if(empty($data))
		{
			\dash\notif::info(T_("No change in your data"));
		}
		else
		{
			$data['datemodified'] = date("Y-m-d H:i:s");

			\lib\db\discount\update::update($data, $load['id']);

			// \dash\notif::ok(T_("Saved"));
		}

		return true;
	}

}
?>