<?php
namespace lib\app\nic_contact;


class add
{
	public static function exists_contact($_old_contact)
	{

		if(!$_old_contact || !is_string($_old_contact))
		{
			\dash\notif::error(T_("Invalid contact"));
			return false;
		}

		$result = \lib\nic\exec\contact::check($_old_contact);
		j($result);

	}
}
?>