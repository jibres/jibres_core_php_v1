<?php
namespace lib\app\nic_usersetting;


class set
{
	public static function set($_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T("Please login to continue"));
			return false;
		}

		$condition =
		[
			'ns1'             => 'dns',
			'ns2'             => 'dns',
			'ns3'             => 'dns',
			'ns4'             => 'dns',
			'autorenewperiod' => ['enum' => ['1year', '5year']],
			'domainlifetime'  => ['enum' => ['3day', '1week','1month', '6month', '1year']],

			'fullname'        => 'enstring_100',
			'phone'           => 'phone',
			'phonecc'         => 'intstring_3',
			'fax'             => 'phone',
			'faxcc'           => 'intstring_3',
			'notifsms'        => 'bit',
			'notifemail'      => 'bit',
			'firstname'       => 'string_100',
			'lastname'        => 'string_100',
			'firstname_en'    => 'enstring_100',
			'lastname_en'     => 'enstring_100',
			'nationalcode'    => 'nationalcode',
			'passportcode'    => 'string_50',
			'company'         => 'string_100',
			'category'        => 'string_100',
			'email'           => 'email',
			'country'         => 'enstring_20',
			'province'        => 'enstring_50',
			'city'            => 'enstring_50',
			'postcode'        => 'enstring_20',
			'address'         => 'enstring_50',
			'mobile'          => 'mobile',
		];

		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);


		$load = \lib\db\nic_usersetting\get::my_setting(\dash\user::id());
		if(isset($load['id']))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\nic_usersetting\update::update($args, $load['id']);
		}
		else
		{
			$args['user_id']     = \dash\user::id();
			$args['datecreated'] = date("Y-m-d H:i:s");
			\lib\db\nic_usersetting\insert::new_record($args);
		}

		\dash\notif::ok(T_("Setting saved"));


	}

}
?>