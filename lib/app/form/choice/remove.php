<?php
namespace lib\app\form\choice;


class remove
{

	public static function remove($_id)
	{

		\dash\permission::access('ManageForm');

		$load = \lib\app\form\choice\get::get($_id);
		if(!$load)
		{
			return false;
		}

		$usedBefore = \lib\db\form_answerdetail\get::choise_id_used($_id);
		if($usedBefore)
		{
			\lib\db\form_choice\update::update(['status' => 'deleted'], $_id);
		}
		else
		{
			\lib\db\form_choice\delete::by_id($_id);
		}



		\dash\notif::ok(T_("Choice removed"));

		return true;
	}
}
?>