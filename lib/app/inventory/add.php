<?php
namespace lib\app\inventory;


class add
{

	public static function add($_args)
	{

		$args = \lib\app\inventory\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$check_duplicate = \lib\db\inventory\get::check_duplicate($args['name']);
		if(isset($check_duplicate['id']))
		{
			\dash\notif::error(T_("Duplicate inventory name"));
			return false;
		}

		$count_all = \lib\db\inventory\get::count_all();
		if(intval($count_all) >= 5)
		{
			\dash\notif::error(T_("You have used the maximum inventory capacity"));
			return false;
		}


		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['status']      = 'enable';


		$id = \lib\db\inventory\insert::new_record($args);
		if(!$id)
		{
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		\dash\notif::ok(T_("Inventory successfully added"));

		$result       = [];
		$result['id'] = $id;
		return $result;
	}



}
?>