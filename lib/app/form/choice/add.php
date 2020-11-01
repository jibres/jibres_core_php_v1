<?php
namespace lib\app\form\choice;


class add
{
	public static function add($_args, $_item_id, $_form_id)
	{
		\dash\permission::access('ManageForm');

		$load = \lib\app\form\form\get::get($_form_id);
		if(!$load)
		{
			return false;
		}

		$load_item = \lib\app\form\item\get::get($_item_id);
		if(!$load_item)
		{
			return false;
		}


		$args = \lib\app\form\choice\check::variable($_args);

		if(!$args)
		{
			return false;
		}


		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['form_id']      = $_form_id;
		$args['item_id']      = $_item_id;

		$id = \lib\db\form_choice\insert::new_record($args);

		\dash\notif::ok(T_("Choice successfully added"));

		return ['id' => $id];
	}
}
?>