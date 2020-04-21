<?php
namespace content_love\domain\domainbuy;


class model
{
	public static function post()
	{
		$user_id = null;
		$mobile = \dash\validate::mobile(\dash\request::post('mobile'));
		if($mobile)
		{
			$user = \dash\db\users::get_by_mobile($mobile);
			if(isset($user['id']))
			{
				$user_id = $user['id'];
			}
		}

		if(!$user_id)
		{
			\dash\notif::error(T_("User not found"));
			return false;
		}

		$price = \lib\app\nic_domain\price::register(\dash\request::post('period'));

		$user_budget = floatval(\dash\db\transactions::budget($user_id));

		if(floatval($price) > $user_budget)
		{
			\dash\notif::error(T_("Please charge user account to register this domain for him"));
			return false;
		}


		$post =
		[
			'user_id'              => $user_id,
			'domain'               => \dash\request::post('domain'),
			'period'               => \dash\request::post('period'),
			'irnic_new'            => \dash\request::post('irnicid-new'),
			'irnic_admin'          => \dash\request::post('irnic_admin'),
			'irnic_tech'           => \dash\request::post('irnic_tech'),
			'irnic_bill'           => \dash\request::post('irnic_bill'),
			'ns1'                  => \dash\request::post('ns1'),
			'ns2'                  => \dash\request::post('ns2'),
			'ns3'                  => \dash\request::post('ns3'),
			'ns4'                  => \dash\request::post('ns4'),
			'agree'                => \dash\request::post('agree'),
			'register_now'         => true,
			'admin_register_force' => true,
			'usebudget'            => true,
		];

		$result = \lib\app\nic_domain\create::new_domain($post);



	}
}
?>
