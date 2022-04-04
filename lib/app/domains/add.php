<?php
namespace lib\app\domains;


class add
{
	public static function add($_domain)
	{
		if(!$_domain)
		{
			\dash\notif::error(T_("Please set the domain"));
			return false;
		}

		$domain = \dash\validate::domain($_domain);

		if(!$domain)
		{
			return false;
		}


		$load_domain = \lib\app\nic_domain\get::is_my_domain($domain);

		if($load_domain)
		{
			\dash\notif::error(T_("This domain already exist in your domain list"));
			return false;
		}

		$user_id = \dash\user::id();
		$registrar = null;
		if(\dash\validate::ir_domain($domain, false))
		{
			$registrar = 'irnic';
		}

		$insert =
		[
			'name'        => $domain,
			'registrar'   => $registrar,
			'user_id'     => $user_id,
			'status'      => 'awaiting',
			'datecreated' => date("Y-m-d H:i:s"),
			'gateway'     => 'import',
			// 'lastfetch'   => date("Y-m-d H:i:s"),
		];

		$insert = \lib\db\nic_domain\insert::new_record($insert);

		$load_domain = \lib\app\nic_domain\get::is_my_domain($domain);

		return $load_domain;

	}
}
?>
