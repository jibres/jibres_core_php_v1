<?php
namespace lib\app\nic_contact;


class edit
{
	public static function remove($_id)
	{
		$load = \lib\app\nic_contact\get::get($_id);

		if(!$load || !isset($load['id']) || !isset($load['nic_id']))
		{
			\dash\notif::error(T_("Contact not found"));
			return false;
		}

		$update = ['status' => 'deleted'];
		$update = \lib\db\nic_contact\update::update($update, $load['id']);
		\dash\notif::ok(T_("Contact removed"));
		return true;
	}


	public static function set_default_contact($_contact)
	{
		$contact = \dash\validate::irnic_id($_contact);
		if(!$contact)
		{
			return false;
		}

		$load_contact = \lib\db\nic_contact\get::by_nic_id($contact, \dash\user::id());
		if(isset($load_contact['id']))
		{
			\lib\db\nic_contact\update::remove_old_default(\dash\user::id());
			\lib\db\nic_contact\update::update(['isdefault' => 1], $load_contact['id']);
			return true;
		}
		else
		{
			\dash\notif::error(T_("This IRNIC contact not found in your list!"));
			return false;
		}
	}


	public static function update($_id)
	{
		$load = \lib\app\nic_contact\get::get($_id);
		if(!$load || !isset($load['id']) || !isset($load['nic_id']))
		{
			return false;
		}

		$nic_id = $load['nic_id'];

		$result = \lib\nic\exec\contact_check::check($nic_id);

		if(isset($result[$nic_id]['avail']) && $result[$nic_id]['avail'] == '1')
		{

			$roid   = isset($result[$nic_id]['roid']) 	? \dash\validate::string($result[$nic_id]['roid']) 	: null;
			$email  = isset($result[$nic_id]['email']) 	? \dash\validate::string($result[$nic_id]['email']) : null;
			$holder = isset($result[$nic_id]['holder']) ? $result[$nic_id]['holder']: null;
			$admin  = isset($result[$nic_id]['admin']) 	? $result[$nic_id]['admin'] : null;
			$tech   = isset($result[$nic_id]['tech']) 	? $result[$nic_id]['tech'] 	: null;
			$bill   = isset($result[$nic_id]['bill']) 	? $result[$nic_id]['bill'] 	: null;


			$holder = $holder 	? 1 : null;
			$admin  = $admin 	? 1 : null;
			$tech   = $tech 	? 1 : null;
			$bill   = $bill 	? 1 : null;

			$update =
			[
				'roid'         => $roid,
				'holder'       => $holder,
				'admin'        => $admin,
				'tech'         => $tech,
				'bill'         => $bill,
				'email'        => $email,
				'datemodified' => date("Y-m-d H:i:s"),
			];

			$update = \lib\db\nic_contact\update::update($update, $load['id']);

			if($update)
			{
				\dash\notif::ok(T_("Contact detail updated"));
			}
			else
			{
				\dash\notif::error(T_("Can not update your account at this time"));
				return false;
			}
		}
		else
		{
			\dash\notif::warn(T_("Can not update your account at this time"));
			return false;
		}
	}


	public static function edit($_args, $_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$load = \lib\app\nic_contact\get::get($_id);
		if(!$load || !isset($load['id']))
		{
			return false;
		}


		$condition =
		[
			'title'     => 'title',
			'isdefault' => 'bit',
		];

		$require = [];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if($data['isdefault'])
		{
			\lib\db\nic_contact\update::remove_old_default(\dash\user::id());

			// $nic_id = isset($load['nic_id']) ? $load['nic_id'] : null;

			// $domain_action_detail =
			// [
			// 	'detail' => json_encode(['nicid' => $nic_id], JSON_UNESCAPED_UNICODE),
			// ];

			// \lib\app\nic_domainaction\action::set('nic_contact_default_set', $domain_action_detail);
		}

		$update = \dash\cleanse::patch_mode($_args, $data);

		if(empty($update))
		{
			\dash\notif::info(T_("No data received to update"));
			return true;
		}

		$contact = \lib\db\nic_contact\update::update($update, $load['id']);
		if($contact)
		{
			\dash\notif::ok(T_("Contact updateded"));
			return true;
		}
		else
		{
			\dash\notif::error(T_("No way to update data"));
			return false;
		}

	}
}
?>