<?php
namespace lib\app\nic_contact;


class add
{
	public static function exists_contact($_old_contact)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		if(!$_old_contact || !is_string($_old_contact))
		{
			\dash\notif::error(T_("Invalid contact"));
			return false;
		}

		$result = \lib\nic\exec\contact::check($_old_contact);
		if(isset($result[$_old_contact]['avail']) && $result[$_old_contact]['avail'] == '1')
		{
			$result = self::add_account($result[$_old_contact]);
			if($result)
			{
				\dash\notif::ok(T_("Contact added to your contact list"));
				return true;
			}
		}
		else
		{
			\dash\notif::error(T_("Contact is not available"), 'oldcontact');
			return false;
		}

	}


	private static function add_account($_detail)
	{
		$id     = isset($_detail['id']) ? $_detail['id'] : null;
		$roid   = isset($_detail['roid']) ? $_detail['roid'] : null;
		$email  = isset($_detail['email']) ? $_detail['email'] : null;

		$holder = isset($_detail['holder']) ? $_detail['holder'] : null;
		$admin  = isset($_detail['admin']) ? $_detail['admin'] : null;
		$tech   = isset($_detail['tech']) ? $_detail['tech'] : null;
		$bill   = isset($_detail['bill']) ? $_detail['bill'] : null;


		$holder = $holder ? 1 : null;
		$admin  = $admin ? 1 : null;
		$tech   = $tech ? 1 : null;
		$bill   = $bill ? 1 : null;

		$insert =
		[
			'user_id'     => \dash\user::id(),
			'nic_id'      => $id,
			'roid'        => $id,
			'holder'      => $holder,
			'admin'       => $admin,
			'tech'        => $tech,
			'bill'        => $bill,
			'email'       => $email,
			'isdefault'   => null,
			'datecreated' => date("Y-m-d H:i:s"),
			'status'      => 'enable',
		];

		$contact = \lib\db\nic_contact\insert::new_record($insert);
		if($contact)
		{
			return true;
		}
		else
		{
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}
	}
}
?>