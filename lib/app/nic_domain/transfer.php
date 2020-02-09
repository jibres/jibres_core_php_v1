<?php
namespace lib\app\nic_domain;


class transfer
{
	public static function transfer($_args)
	{
		$domain = isset($_args['domain']) 	? $_args['domain'] 	: null;
		$nic_id  = isset($_args['nic_id']) 	? $_args['nic_id'] 	: null;

		$pin  = isset($_args['pin']) 	? $_args['pin'] 	: null;

		if(!$domain)
		{
			\dash\notif::error(T_("Please set domain"));
			return false;
		}


		if(!\lib\app\nic_domain\check::syntax($domain))
		{
			\dash\notif::error(T_("Invalid domain syntax"));
			return false;
		}


		if(!$pin)
		{
			\dash\notif::error(T_("Please set pin"));
			return false;
		}



		$ready =
		[
			'nic_id' => $nic_id,
			'domain' => $domain,
			'pin' => $pin,

		];

		$result = \lib\nic\exec\domain_transfer::transfer($ready);

		if($result)
		{
			$insert =
			[
				'user_id'      => \dash\user::id(),
				'name'         => $domain,
				'registrar'    => 'irnic',
				'status'       => 'enable',
				'holder'       => $nic_id,
				'admin'        => $nic_id,
				'tech'         => $nic_id,
				'bill'         => $nic_id,
				'autorenew'    => null,
				'lock'         => 1,
				'dns'          => $dnsid,
				'dateregister' => $result['dateregister'],
				'dateexpire'   => $result['dateexpire'],
				'datetransferd'  => date("Y-m-d H:i:s"),
			];

			$domain_id = \lib\db\nic_domain\insert::new_record($insert);
			if(!$domain_id)
			{
				// must be roolback money
				\dash\notif::error(T_("Error"));
				return false;
			}

			$insert_action =
			[
				'domain_id'   => $domain_id,
				'user_id'     => \dash\user::id(),
				'status'      => 'enable',
				'action'      => 'transfer',
				'meta'        => null,
				'date'        => date("Y-m-d H:i:s"),
				'datetransferd' => date("Y-m-d H:i:s"),
			];

			$domain_action_id = \lib\db\nic_domain_action\insert::new_record($insert_action);

			\dash\notif::ok(T_("Your domain was transfered"));

			return true;

		}

	}
}
?>