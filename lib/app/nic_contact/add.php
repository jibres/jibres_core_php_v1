<?php
namespace lib\app\nic_contact;


class add
{
	public static function quick($_nic_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		if(!$_nic_id || !is_string($_nic_id))
		{
			\dash\notif::error(T_("Invalid contact"));
			return false;
		}

		if(substr($_nic_id, -6) !== '-irnic')
		{
			$_nic_id = $_nic_id. '-irnic';
		}

		$check_duplicate = \lib\db\nic_contact\get::check_duplicate(\dash\user::id(), $_nic_id);
		if($check_duplicate)
		{
			return $_nic_id;
		}

		$result = \lib\nic\exec\contact_check::check($_nic_id);

		if(isset($result[$_nic_id]['avail']) && $result[$_nic_id]['avail'] == '1')
		{
			$result = self::add_account($result[$_nic_id]);
			if($result)
			{
				return $_nic_id;
			}
			else
			{
				\dash\notif::error(T_("Can not add your contact"));
				return false;
			}
		}
		else
		{
			return false;
		}
	}


	public static function exists_contact($_old_contact, $_title)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		if(!$_old_contact || !is_string($_old_contact))
		{
			\dash\notif::error(T_("Invalid IRNIC Handle"));
			return false;
		}


		if(substr($_old_contact, -6) !== '-irnic')
		{
			$_old_contact = $_old_contact. '-irnic';
		}

		$check_duplicate = \lib\db\nic_contact\get::check_duplicate(\dash\user::id(), $_old_contact);
		if($check_duplicate)
		{
			\dash\notif::error(T_("You already added this one to your IRNIC handle list"));
			return false;
		}

		$result = \lib\nic\exec\contact_check::check($_old_contact);

		if(isset($result[$_old_contact]['avail']) && $result[$_old_contact]['avail'] == '1')
		{
			// $info = \lib\nic\exec\contact_info::info($_old_contact);
			$result = self::add_account($result[$_old_contact], $_title);
			if($result)
			{
				\dash\notif::ok(T_("IRNIC handle added successfully"));
				return true;
			}
		}
		elseif(isset($result[$_old_contact]['avail']) && $result[$_old_contact]['avail'] == '0')
		{
			\dash\notif::error(T_("This IRNIC handle is not available!"));
			return false;
		}
		else
		{
			\dash\notif::clean();
			\dash\notif::error(T_("Can not add your IRNIC Handle"));
			return false;
		}

	}


	private static function add_account($_detail, $_title = null)
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

		if($_title && mb_strlen($_title) > 100)
		{
			\dash\notif::error(T_("Title is out of range"), 'titleold');
			return false;
		}

		$insert =
		[
			'title'       => $_title,
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
			\dash\notif::error(T_("This IRNIC Handle already added to your IRNIC Handle list"));
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


		$title    	  = (isset($_args['title']) 	    && is_string($_args['title']))		     ? $_args['title'] 		    : null;
		$firstname    = (isset($_args['firstname']) 	&& is_string($_args['firstname']))		 ? $_args['firstname'] 	 	: null;
		$lastname     = (isset($_args['lastname']) 		&& is_string($_args['lastname']))		 ? $_args['lastname'] 		: null;
		$nationalcode = (isset($_args['nationalcode']) 	&& is_string($_args['nationalcode']))	 ? $_args['nationalcode'] 	: null;
		$email        = (isset($_args['email']) 		&& is_string($_args['email']))			 ? $_args['email'] 			: null;
		$country      = (isset($_args['country']) 		&& is_string($_args['country']))		 ? $_args['country'] 		: null;
		$province     = (isset($_args['province']) 		&& is_string($_args['province']))		 ? $_args['province'] 		: null;
		$city         = (isset($_args['city']) 			&& is_string($_args['city']))			 ? $_args['city'] 			: null;
		$postcode     = (isset($_args['postcode']) 		&& is_string($_args['postcode']))		 ? $_args['postcode'] 		: null;
		$phone        = (isset($_args['phone']) 		&& is_string($_args['phone']))			 ? $_args['phone'] 			: null;
		$address      = (isset($_args['address']) 		&& is_string($_args['address']))		 ? $_args['address'] 		: null;

		$nationalcode = \dash\number::clean($nationalcode);
		$postcode     = \dash\number::clean($postcode);
		$phone        = \dash\number::clean($phone);


		if($title && mb_strlen($title) > 100)
		{
			\dash\notif::error(T_("Title must be less than 100 character"), 'title');
			return false;
		}

		if(!$firstname)
		{
			\dash\notif::error(T_("Firstname is required"), 'firstname');
			return false;
		}

		if(mb_strlen($firstname) > 70)
		{
			\dash\notif::error(T_("Firstname must be less than 70 character"), 'firstname');
			return false;
		}

		if(!$lastname)
		{
			\dash\notif::error(T_("Firstname is required"), 'lastname');
			return false;
		}

		if(mb_strlen($lastname) > 70)
		{
			\dash\notif::error(T_("Firstname must be less than 70 character"), 'lastname');
			return false;
		}

		if(!preg_match("/^[a-zA-Z0-9\s]+$/", $firstname))
		{
			\dash\notif::error(T_("Please set your firstname in latin characters"), 'firstname');
			return false;
		}

		if(!preg_match("/^[a-zA-Z0-9\s]+$/", $lastname))
		{
			\dash\notif::error(T_("Please set your lastname in latin characters"), 'lastname');
			return false;
		}

		if($country && !\dash\utility\location\countres::check($country))
		{
			\dash\notif::error(T_("Invalid country"), 'country');
			return false;
		}

		if(!$country)
		{
			\dash\notif::error(T_("Please choose your country"), 'country');
			return false;
		}

		if($province && mb_strlen($province) > 100)
		{
			\dash\notif::error(T_("Please set province less than 100 character"), 'province');
			return false;
		}

		if(!preg_match("/^[a-zA-Z0-9\s]+$/", $province))
		{
			\dash\notif::error(T_("Please set your province in latin characters"), 'province');
			return false;
		}


		if($city && mb_strlen($city) > 100)
		{
			\dash\notif::error(T_("Please set city less than 100 character"), 'city');
			return false;
		}


		if(!$province)
		{
			\dash\notif::error(T_("Please choose your province"), 'province');
			return false;
		}

		if(!$city)
		{
			\dash\notif::error(T_("Please choose your city"), 'city');
			return false;
		}

		if(!preg_match("/^[a-zA-Z0-9\s]+$/", $city))
		{
			\dash\notif::error(T_("Please set your city in latin characters"), 'city');
			return false;
		}

		if(!$nationalcode)
		{
			\dash\notif::error(T_("Please set your nationalcode"), 'nationalcode');
			return false;
		}

		if(!\dash\utility\filter::nationalcode($nationalcode))
		{
			\dash\notif::error(T_("Invalid nationalcode"), 'nationalcode');
			return false;
		}

		if(!$postcode)
		{
			\dash\notif::error(T_("Please set postcode"), 'postcode');
			return false;
		}

		if(!is_numeric($postcode))
		{
			\dash\notif::error(T_("Please set pos code as a number"), 'postcode');
			return false;
		}


		if(!$address)
		{
			\dash\notif::error(T_("Please set address"), 'address');
			return false;
		}

		if(mb_strlen($address) > 100)
		{
			\dash\notif::error(T_("Please set address less than 100 characters"), 'address');
			return false;
		}

		if(!preg_match("/^[a-zA-Z0-9\s\,\-]+$/", $address))
		{
			\dash\notif::error(T_("Please set your address in latin characters"), 'address');
			return false;
		}

		$signator = trim($firstname. ' '. $lastname);

		$ready =
		[
			'title'        => $title,
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
			'signator'     => $signator,
		];


		$result = \lib\nic\exec\contact_create::create($ready);

		if(isset($result['nic_id']))
		{
			$id     = isset($result['nic_id']) ? $result['nic_id'] : null;
			$roid   = null;

			// i create it
			$holder = 1;
			$admin  = 1;
			$tech   = 1;
			$bill   = 1;

			$insert =
			[
				'title'        => $title,
				'user_id'      => \dash\user::id(),
				'nic_id'       => $id,
				'roid'         => $id,
				'holder'       => $holder,
				'admin'        => $admin,
				'tech'         => $tech,
				'bill'         => $bill,
				'email'        => $email,
				'isdefault'    => null,
				'datecreated'  => date("Y-m-d H:i:s"),
				'status'       => 'enable',
				'firstname'    => null,
				'lastname'     => null,
				'firstname_en' => $firstname,
				'lastname_en'  => $lastname,
				'nationalcode' => $nationalcode,
				'passportcode' => $nationalcode,
				'company'      => null,
				'category'     => null,
				'email'        => $email,
				'country'      => $country,
				'province'     => $province,
				'city'         => $city,
				'postcode'     => $postcode,
				'address'      => $address,
				'mobile'       => \dash\user::detail('mobile'),
				'signator'     => $signator,

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
				\dash\notif::ok(T_("Contact created"));
				return true;
			}
			else
			{
				\dash\notif::error(T_("No way to insert data"));
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}
?>