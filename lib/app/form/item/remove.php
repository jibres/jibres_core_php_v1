<?php
namespace lib\app\form\item;


class remove
{

	public static function remove($_id)
	{

		$load = \lib\app\form\item\get::get($_id);
		if(!$load)
		{
			return false;
		}

		$check_answer = \lib\db\form_answerdetail\get::by_item_id($_id);
		if(isset($check_answer['id']))
		{
			\lib\db\form_item\update::update(['status' => 'deleted'], $_id);
		}
		else
		{
			// check not answer to this

			\lib\db\form_item\delete::by_id($_id);

		}

		\dash\notif::ok(T_("Item removed"));

		return true;
	}
}
?>