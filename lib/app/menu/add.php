<?php
namespace lib\app\menu;


class add
{
	public static function add($_args, $_force = false)
	{
		if(!$_force)
		{
			\dash\permission::access('_group_setting');
		}

		$args = \lib\app\menu\check::variable($_args);

		$args = \lib\app\menu\check::unset_gallery_index($args);

		if(!$args)
		{
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");

		if(!a($args, 'for'))
		{
			$args['for'] = 'menu';
		}

		$id = \lib\db\menu\insert::new_record($args);

		if(!$_force)
		{
			\dash\notif::ok(T_("Menu created"));
		}

		return ['id' => $id];
	}



	public static function menu_item($_args, $_id, $_force = false)
	{
		$_args['parent'] = $_id;
		return self::add($_args, $_force);
	}


}
?>