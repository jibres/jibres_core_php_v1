<?php
namespace lib\app\tax\coding;


class edit
{

	public static function edit($_args, $_id)
	{
		$load = \lib\app\tax\coding\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$args = \lib\app\tax\coding\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$data = \dash\cleanse::patch_mode($_args, $args);

		if(empty($data))
		{
			\dash\notif::info(T_("No change in your data"));
		}
		else
		{
			$data['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\tax_coding\update::update($data, $load['id']);
			\dash\notif::ok(T_("Accounting coding successfully updated"));
		}

		return true;
	}

}
?>