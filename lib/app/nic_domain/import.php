<?php
namespace lib\app\nic_domain;


class import
{
	public static function import($_args)
	{
		$domains = null;
		if(isset($_args['domains']) && is_string($_args['domains']))
		{
			$domains = $_args['domains'];
		}

		if(!$domains)
		{
			\dash\notif::error(T_("Please fill your domain list"), 'domains');
			return false;
		}

		if(mb_strlen($domains) > 10000)
		{
			\dash\notif::error(T_("Maximum input of import domain is 10,000 character"), 'domains');
			return false;
		}

		$autorenew = null;
		if(isset($_args['autorenew']) && $_args['autorenew'])
		{
			$autorenew = 1;
		}

		$domains_explode = explode("\n", $domains);

		$valid_domain = [];

		$error_ir_domain = false;

		foreach ($domains_explode as $key => $value)
		{
			$temp = \dash\validate::ir_domain($value, false);

			if($temp)
			{
				$valid_domain[] = $temp;
			}
			else
			{
				if(\dash\validate::domain($value, false))
				{
					if(!$error_ir_domain)
					{
						$error_ir_domain = true;

						\dash\notif::warn(T_("Only ir domain can be import. We found a non-ir domain in your list"));
					}
				}
			}
		}

		if(empty($valid_domain))
		{
			\dash\notif::error(T_("No valid domain find in your text"), 'domains');
			return false;
		}

		if(count($valid_domain) > 50)
		{
			\dash\notif::error(T_("Maximum domain in one request is 50 domain"), 'domains');
			return false;
		}

		$check_duplicate = \lib\db\nic_domain\get::check_multi_duplicate($valid_domain, \dash\user::id());

		foreach ($check_duplicate as $key => $exist_domain)
		{
			if(isset($exist_domain['name']))
			{
				if(in_array($exist_domain['name'], $valid_domain))
				{
					unset($valid_domain[array_search($exist_domain['name'], $valid_domain)]);
				}
			}
		}

		if(empty($valid_domain))
		{
			\dash\notif::info(T_("All valid domain was exists in your list"), 'domains');
			return false;
		}

		$insert_multi = [];

		$user_id = \dash\user::id();

		foreach ($valid_domain as $key => $value)
		{
			$insert_multi[] =
			[
				'name'        => $value,
				'registrar'   => 'irnic',
				'autorenew'   => $autorenew,
				'user_id'     => $user_id,
				'status'      => 'awaiting',
				'datecreated' => date("Y-m-d H:i:s"),
				'gateway'     => 'import',
				// 'lastfetch'   => date("Y-m-d H:i:s"),
			];
		}

		$insert = \lib\db\nic_domain\insert::multi_insert($insert_multi);

		if($insert)
		{
			// fetch now
			foreach ($insert_multi as $key => $value)
			{
				if(isset($value['name']))
				{
					\lib\app\nic_domain\get::force_fetch($value['name']);
				}
			}

			$domain_action_detail =
			[
				'detail'         => json_encode(['count' => count($insert_multi)], JSON_UNESCAPED_UNICODE),
			];

			\lib\app\nic_domainaction\action::set('domain_imported', $domain_action_detail);

			\dash\notif::ok(T_(":val Domain added to your list", ['val' => \dash\fit::number(count($insert_multi))]));
		}
		else
		{
			\dash\log::oops('db');
		}
	}
}
?>
