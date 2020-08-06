<?php
namespace lib\app\tax\doc;


class edit
{

	public static function edit($_args, $_id)
	{
		$load = \lib\app\tax\doc\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$args = \lib\app\tax\doc\check::variable($_args);

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
			\lib\db\tax_document\update::update($data, $load['id']);
			\dash\notif::ok(T_("Accounting doc successfully updated"));
		}

		return true;
	}

}
?>