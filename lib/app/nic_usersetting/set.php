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
			'domainlifetime'  => ['enum' => ['3day', '1week','1month', '6month', '1year', '3year']],
		];

		$data = \dash\cleanse::input($_args, $condition, [], []);

		$load = \lib\db\nic_usersetting\get::my_setting(\dash\user::id());
		if(isset($load['id']))
		{
			$data['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\nic_usersetting\update::update($data, $load['id']);
		}
		else
		{
			$data['user_id']     = \dash\user::id();
			$data['datecreated'] = date("Y-m-d H:i:s");
			\lib\db\nic_usersetting\insert::new_record($data);
		}

		\dash\notif::ok(T_("Setting saved"));


	}

}
?>