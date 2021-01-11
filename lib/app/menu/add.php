<?php
namespace lib\app\menu;


class add
{
	public static function add($_args)
	{

		\dash\permission::access('_group_setting');

		$args = \lib\app\menu\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");

		$id = \lib\db\menu\insert::new_record($args);

		\dash\notif::ok(T_("Menu created"));

		return ['id' => $id];
	}



	public static function menu_item($_args, $_id)
	{
		$_args['parent'] = $_id;
		return self::add($_args);
	}


}
?>