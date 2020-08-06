<?php
namespace lib\app\tax\coding;


class add
{

	public static function add($_args)
	{

		$args = \lib\app\tax\coding\check::variable($_args);


		if(!$args)
		{
			return false;
		}

		\lib\db\tax_coding\insert::new_record($args);

		\dash\notif::ok(T_("Accounting coding successfully added"));

		return true;
	}

}
?>