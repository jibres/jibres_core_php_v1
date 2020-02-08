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

		$result = \lib\nic\exec\contact_check::check($_old_contact);
		if(isset($result[$_old_contact]['avail']) && $result[$_old_contact]['avail'] == '1')
		{
			// $info = \lib\nic\exec\contact_info::info($_old_contact);
			$result = self::add_account($result[$_old_contact]);
			if($result)
			{
				\dash\notif::ok(T_("Contact added to your contact list"));
				return true;
			}
		}
		else
		{
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

		$check_duplicate = \lib\db\nic_contact\get::check_duplicate(\dash\user::id(), $id);
		if($check_duplicate)
		{
			\dash\notif::error(T_("This contact already added to your contact list"));
			return false;
		}

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


	public static function create_new($_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$firstname    = (isset($_args['firstname']) 	&& is_string($_args['firstname']))		 ? $_args['firstname'] 		: null;
		$lastname     = (isset($_args['lastname']) 		&& is_string($_args['lastname']))		 ? $_args['lastname'] 		: null;
		$nationalcode = (isset($_args['nationalcode']) 	&& is_string($_args['nationalcode']))	 ? $_args['nationalcode'] 	: null;
		$email        = (isset($_args['email']) 		&& is_string($_args['email']))			 ? $_args['email'] 			: null;
		$country      = (isset($_args['country']) 		&& is_string($_args['country']))		 ? $_args['country'] 		: null;
		$province     = (isset($_args['province']) 		&& is_string($_args['province']))		 ? $_args['province'] 		: null;
		$city         = (isset($_args['city']) 			&& is_string($_args['city']))			 ? $_args['city'] 			: null;
		$postcode     = (isset($_args['postcode']) 		&& is_string($_args['postcode']))		 ? $_args['postcode'] 		: null;
		$phone        = (isset($_args['phone']) 		&& is_string($_args['phone']))			 ? $_args['phone'] 			: null;
		$address      = (isset($_args['address']) 		&& is_string($_args['address']))		 ? $_args['address'] 		: null;

		// if(!$firstname)
		// {
		// 	\dash\notif::error(T_("Firstname is required"), 'firstname');
		// 	return false;
		// }

		// if(mb_strlen($firstname) > 70)
		// {
		// 	\dash\notif::error(T_("Firstname must be less than 70 character"), 'firstname');
		// 	return false;
		// }

		// if(!$lastname)
		// {
		// 	\dash\notif::error(T_("Firstname is required"), 'lastname');
		// 	return false;
		// }

		// if(mb_strlen($lastname) > 70)
		// {
		// 	\dash\notif::error(T_("Firstname must be less than 70 character"), 'lastname');
		// 	return false;
		// }


		// $firstname    = 'Reza';
		// $lastname     = 'Mohiti';
		// $nationalcode = '2754854460';
		// $email        = 'info@dddsssff.com';
		// $country      = 'IR';
		// $province     = 'Qom';
		// $city         = 'Qom';
		// $postcode     = '4564555887';
		// $address      = 'St mahallaty. number 288';


		$ready =
		[
			'firstname'    => $firstname,
			'lastname'     => $lastname,
			'nationalcode' => $nationalcode,
			'email'        => $email,
			'country'      => $country,
			'province'     => $province,
			'city'         => $city,
			'postcode'     => $postcode,
			'address'      => $address,
			'mobile'       => \dash\user::detail('mobile'),
			'passportcode' => null,
			'signator'     => 'Reza Mohiti',
		];


		$result = \lib\nic\exec\contact_create::create($ready);

		j($result);

		if(isset($result['nic_id']))
		{

		}

		if(isset($result[$_old_contact]['avail']) && $result[$_old_contact]['avail'] == '1')
		{
			$info = \lib\nic\exec\contact::info($_old_contact);

			$result = self::add_account($result[$_old_contact], $info);
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
}
?>