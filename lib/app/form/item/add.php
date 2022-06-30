<?php
namespace lib\app\form\item;


class add
{
	public static function add($_args, $_form_id)
	{
		\dash\permission::access('ManageForm');

		$load = \lib\app\form\form\get::get($_form_id);
		if(!$load)
		{
			return false;
		}


		$args = \lib\app\form\item\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		unset($args['checkrequire']);
		unset($args['checkhidden']);


		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['form_id']      = $_form_id;

		$id = \lib\db\form_item\insert::new_record($args);

		\dash\notif::ok(T_("Form item successfully added"));

		return ['id' => $id];
	}
}
?>