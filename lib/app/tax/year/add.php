<?php
namespace lib\app\tax\year;


class add
{

	public static function add($_args)
	{

		$args = \lib\app\tax\year\check::variable($_args);


		if(!$args)
		{
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['status']      = 'enable';

		$id = \lib\db\tax_year\insert::new_record($args);

		\dash\notif::ok(T_("Accounting year successfully added"));

		return ['id' => $id];
	}

}
?>