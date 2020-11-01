<?php
namespace lib\app\form\form;


class add
{
	public static function add($_args)
	{

		\dash\permission::access('ManageForm');

		$args = \lib\app\form\form\check::variable($_args);

		if(!$args)
		{
			return false;
		}


		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['status']      = 'publish';
		$args['user_id']     = \dash\user::id();

		$id = \lib\db\form\insert::new_record($args);

		\dash\notif::ok(T_("Contact form successfully added"));

		return ['id' => $id];
	}


	public static function duplicate($_args, $_id)
	{

		\dash\permission::access('ManageForm');

		$args = \lib\app\form\form\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$load = \lib\app\form\form\get::get($_id);
		if(!$load)
		{
			return false;
		}

		$id = \lib\db\form\insert::duplicate($_id, $args['title']);
		if($id)
		{
			\dash\notif::ok(T_("Contact form successfully added"));

			return ['id' => $id];
		}
		else
		{
			\dash\notif::error(T_("Can not duplicate this form"));
			return false;
		}

	}
}
?>