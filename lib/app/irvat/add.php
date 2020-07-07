<?php
namespace lib\app\irvat;


class add
{

	public static function add($_args)
	{

		$args = \lib\app\irvat\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['creator']      = \dash\user::id();


		$id = \lib\db\irvat\insert::new_record($args);
		if(!$id)
		{
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		\dash\notif::ok(T_("Factor successfully added"));

		$result       = [];
		$result['id'] = $id;
		return $result;
	}



}
?>