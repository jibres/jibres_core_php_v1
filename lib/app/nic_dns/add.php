<?php
namespace lib\app\nic_dns;


class add
{
	public static function quick($_ns1, $_ns2)
	{
		$ns1 = \dash\validate::dns($_ns1, 'ns1');
		$ns2 = \dash\validate::dns($_ns2, 'ns2');

		if(!$ns1 && !$ns2)
		{
			return false;
		}

		\lib\app\domains\detect::dns($ns1);
		\lib\app\domains\detect::dns($ns2);

		$insert =
		[
			'user_id'     => \dash\user::id(),
			'ns1'         => $ns1,
			'ns2'         => $ns2,
			'status'      => 'enable',
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$dns_id = \lib\db\nic_dns\insert::new_record($insert);
		if(!$dns_id)
		{
			\dash\notif::error(T_("No way to insert dns"));
			return false;
		}

		return $dns_id;
	}


	public static function new_record($_args)
	{
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

		$isdefault = $data['isdefault'];


		\lib\app\domains\detect::dns($ns1);
		\lib\app\domains\detect::dns($ns2);
		\lib\app\domains\detect::dns($ns3);
		\lib\app\domains\detect::dns($ns4);

		if($isdefault)
		{
			\lib\db\nic_dns\update::remove_old_default(\dash\user::id());
		}

		$insert =
		[
			'user_id'     => \dash\user::id(),
			'title'       => $title,
			'ns1'         => $ns1,
			'ip1'         => $ip1,
			'ns2'         => $ns2,
			'ip2'         => $ip2,
			'ns3'         => $ns3,
			'ip3'         => $ip3,
			'ns4'         => $ns4,
			'ip4'         => $ip4,
			'isdefault'   => $isdefault,
			'status'      => 'enable',
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$dns_id = \lib\db\nic_dns\insert::new_record($insert);
		if(!$dns_id)
		{
			\dash\notif::error(T_("No way to insert dns"));
		}

		return $dns_id;
	}

}
?>