<?php
namespace lib\app\nic_dns;


class edit
{
	public static function edit($_args, $_id)
	{
		$load = \lib\app\nic_dns\get::get($_id);
		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$inUse = false;
		if(isset($load['count_useage']) && intval($load['count_useage']) > 0)
		{
			$inUse = true;
		}

		$condition =
		[
			'title'     => 'title',
			'ns1'       => 'dns',
			'ip1'       => 'ip',
			'ns2'       => 'dns',
			'ip2'       => 'ip',
			'ns3'       => 'dns',
			'ip3'       => 'ip',
			'ns4'       => 'dns',
			'ip4'       => 'ip',
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


		$title = $data['title'];

		$ns1   = $data['ns1'];
		$ip1   = $data['ip1'];

		$ns2   = $data['ns2'];
		$ip2   = $data['ip2'];

		$ns3   = $data['ns3'];
		$ip3   = $data['ip3'];

		$ns4   = $data['ns4'];
		$ip4   = $data['ip4'];


		\lib\app\domains\detect::dns($ns1);
		\lib\app\domains\detect::dns($ns2);
		\lib\app\domains\detect::dns($ns3);
		\lib\app\domains\detect::dns($ns4);


		$isdefault = $data['isdefault'];


		if($isdefault)
		{
			\lib\db\nic_dns\update::remove_old_default(\dash\user::id());
		}

		$update =
		[
			'title'     => $title,
			'isdefault' => $isdefault,
			'status'    => 'enable',
		];

		if(!$inUse)
		{
			$update = array_merge($update,
			[
				'ns1' => $ns1,
				'ip1' => $ip1,
				'ns2' => $ns2,
				'ip2' => $ip2,
				'ns3' => $ns3,
				'ip3' => $ip3,
				'ns4' => $ns4,
				'ip4' => $ip4,
			]);
		}

		$update_arg = \dash\cleanse::patch_mode($_args, $update);

		if(empty($update_arg))
		{
			\dash\notif::info(T_("Your dns saved without change"));
			return false;
		}

		$update_dns = \lib\db\nic_dns\update::update($update_arg, $load['id']);
		if($update_dns)
		{
			\dash\notif::ok(T_("DNS record successfully updated"));
			return true;
		}

		\dash\notif::error(T_("No way to update dns"));
		return false;

	}


	public static function remove($_id)
	{
		$load = \lib\app\nic_dns\get::get($_id);
		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$inUse = false;
		if(isset($load['count_useage']) && intval($load['count_useage']) > 0)
		{
			$inUse = true;
		}

		if($inUse)
		{
			\dash\notif::error(T_("This dns in use and can not be removed"));
			return false;
		}


		$update =
		[
			'status'    => 'deleted',
		];


		$update_dns = \lib\db\nic_dns\update::update($update, $load['id']);
		if($update_dns)
		{
			\dash\notif::ok(T_("DNS record successfully removed"));
			return true;
		}

		\dash\notif::error(T_("No way to remove dns"));
		return false;

	}
}
?>