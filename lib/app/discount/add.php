<?php
namespace lib\app\discount;


class add
{

	public static function add($_args)
	{

		$args = \lib\app\discount\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$check_duplicate_title = \lib\db\discount\get::check_duplicate_code($args['code']);

		if(isset($check_duplicate_title['id']))
		{
			\dash\notif::error(T_("This discount code is exist in your list. Try another"));
			return false;
		}

		$args['status']      = 'draft';
		$args['creator']     = \dash\user::id();
		$args['datecreated'] = date("Y-m-d H:i:s")

		$id = \lib\db\discount\insert::new_record($args);

		\dash\notif::ok(T_("Discount code successfully added"));

		return ['id' => $id];
	}

}
?>