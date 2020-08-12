<?php
namespace lib\app\tax\year;


class edit
{

	public static function edit($_args, $_id)
	{
		$load = \lib\app\tax\year\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$args = \lib\app\tax\year\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		unset($args['startdate']);
		unset($args['enddate']);

		$data = \dash\cleanse::patch_mode($_args, $args);

		if(empty($data))
		{
			\dash\notif::info(T_("No change in your data"));
		}
		else
		{
			$data['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\tax_year\update::update($data, $load['id']);
			\dash\notif::ok(T_("Accounting year successfully updated"));
		}

		return true;
	}

}
?>