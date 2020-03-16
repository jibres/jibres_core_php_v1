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

		$_nic_id = \dash\validate::irnic_id($_nic_id);

		if(!$_nic_id)
		{
			\dash\notif::error(T_("Invalid contact"));
			return false;
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

		$_old_contact = \dash\validate::irnic_id($_old_contact);


		if(!$_old_contact)
		{
			\dash\notif::error(T_("Invalid IRNIC Handle"));
			return false;
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

		$id     = isset($_detail['id']) ? \dash\validate::string($_detail['id']) : null;
		$roid   = isset($_detail['roid']) ? \dash\validate::string($_detail['roid']) : null;
		$email  = isset($_detail['email']) ? \dash\validate::string($_detail['email']) : null;

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

		$condition =
		[
			'title'        => 'title',
			'firstname'    => 'displayname',
			'lastname'     => 'displayname',
			'nationalcode' => 'nationalcode',
			'email'        => 'email',
			'country'      => 'country',
			'province'     => 'string',
			'city'         => 'string',
			'postcode'     => 'postcode',
			'phone'        => 'phone',
			'address'      => 'address',
		];

		$require = ['firstname', 'lastname', 'country', 'province', 'city', 'postcode','address', 'nationalcode'];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$title    	  = $data['title'];
		$firstname    = $data['firstname'];
		$lastname     = $data['lastname'];
		$nationalcode = $data['nationalcode'];
		$email        = $data['email'];
		$country      = $data['country'];
		$province     = $data['province'];
		$city         = $data['city'];
		$postcode     = $data['postcode'];
		$phone        = $data['phone'];
		$address      = $data['address'];


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


		if(!preg_match("/^[a-zA-Z0-9\s]+$/", $province))
		{
			\dash\notif::error(T_("Please set your province in latin characters"), 'province');
			return false;
		}

		if(!preg_match("/^[a-zA-Z0-9\s]+$/", $city))
		{
			\dash\notif::error(T_("Please set your city in latin characters"), 'city');
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