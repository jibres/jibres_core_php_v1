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
		if(isset($result[$_old_contact]['avail']) && $result[$_old_contact]['avail'] == '1')
		{
			j($result);
		}
		else
		{
			\dash\notif::error(T_("Contact is not available"), 'oldcontact');
			return false;
		}

	}
}
?>