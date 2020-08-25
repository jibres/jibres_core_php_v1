<?php
namespace lib\app\form\form;


class add
{
	public static function add($_args)
	{

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("You are not in this business"));
			return false;
		}

		$args = \lib\app\form\form\check::variable($_args);

		if(!$args)
		{
			return false;
		}


		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['status']      = 'draft';
		$args['user_id']     = \dash\user::id();

		$id = \lib\db\form\insert::new_record($args);

		\dash\notif::ok(T_("Contact form successfully added"));

		return ['id' => $id];
	}
}
?>