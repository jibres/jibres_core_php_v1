<?php
namespace lib\app\nic_domain;


class renew
{
	public static function renew($_args)
	{

		if(!\dash\user::id())
		{
			return;
		}

		$condition =
		[
			'domain'      => 'ir_domain',
			'agree'      => 'bit',
			'period'      => ['enum' => ['1year', '5year']],
		];

		$require = ['domain', 'period'];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		if(isset($_args['agree']) && $_args['agree'])
		{
			// nothing
		}
		else
		{
			\dash\notif::error(T_("Please view the privacy policy and check 'I agree' check box"), 'agree');
			return false;
		}

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$domain = $data['domain'];
		$period = $data['period'];

		$transaction_id = null;

		$period_month = 0;

		$price = \lib\app\nic_domain\price::renew($period);

		if($period === '1year')
		{
			$period_month = 12;

		}
		elseif($period === '5year')
		{
			$period_month = 5*12;
		}

		$domain_id = null;

		\lib\app\domains\detect::domain('start_renew', $domain);


		$load_domain = \lib\db\nic_domain\get::domain_user($domain, \dash\user::id());
		if(isset($load_domain['id']))
		{
			$domain_id = $load_domain['id'];
		}
		else
		{
			$insert =
			[
				'user_id'      => \dash\user::id(),
				'name'         => $domain,
				'registrar'    => 'irnic',
				'status'       => 'awaiting',
				'holder'       => null,
				'admin'        => null,
				'tech'         => null,
				'bill'         => null,
				'autorenew'    => null,
				'lock'         => 1,
				'dns'          => null,
				'dateregister' => null,
				'dateexpire'   => null,
				'verify'       => null, // in renew is not verify for this user
				'datecreated'  => date("Y-m-d H:i:s"),
			];

			$domain_id = \lib\db\nic_domain\insert::new_record($insert);
		}



		$get_domain_detail = \lib\app\nic_domain\check::info($domain);

		if(!isset($get_domain_detail['exDate']))
		{
			// \dash\notif::error(T_("Domain is not exists"));
			return false;
		}

		$current_expiredate = date("Y-m-d", strtotime($get_domain_detail['exDate']));

		$current_date_expire      = $get_domain_detail['exDate'];

		$current_date_expire_time = strtotime($current_date_expire);

		$new_date_expire          = ($period_month * 30*24*60*60);

		$new_date_expire          = $current_date_expire_time + $new_date_expire;

		$expiredate               = date("Y-m-d", $new_date_expire);

		$year_6 = time() + (60*60*24*365*6);

		if($new_date_expire >= $year_6)
		{
			\dash\notif::error(T_("Maximum renew date is 6 year"));
			return false;
		}

		$jibres_nic_contact = 'ji128-irnic';

		if((isset($get_domain_detail['reseller']) && $get_domain_detail['reseller'] === $jibres_nic_contact) || (isset($get_domain_detail['bill']) && $get_domain_detail['bill'] === $jibres_nic_contact))
		{
			// nothing
		}
		else
		{
			\dash\temp::set('ji128-irnic-not-allow', true);
			$msg = T_("We can not renew this domain because the bill holder of IRNIC can not access to renew");
			$msg .= '<br>';
			$msg .= T_("If you are administrator of this domain Your must go to nic.ir and set billing holder of this domain on 'ji128-irnic' ");
			$msg .= '<br>';
			$msg .= '<a href="'.\dash\url::support().'/domain" target="_blank">'. T_("Read about this problem"). '</a>';

			\dash\notif::error(1,['target1' => '#myidx', 'timeout' => 0, 'alerty' => true, 'html' => $msg]);

			// \dash\notif::error(T_("We can not renew this domain because the bill holder of IRNIC can not access to renew"));
			return false;
		}

		// $get_contac_nic =  \lib\nic\exec\contact_check::check($get_domain_detail['bill']);
		// if(!isset($get_contac_nic[$get_domain_detail['bill']]))
		// {
		// 	\dash\notif::error(T_("Can not find  billing account detail of this domain"));
		// 	return false;
		// }

		// $get_contac_nic = $get_contac_nic[$get_domain_detail['bill']];
		// if(isset($get_contac_nic['bill']) && $get_contac_nic['bill'] == '1')
		// {
		// 	// no problem to renew this domain by tihs contact
		// }
		// else
		// {
		// 	\dash\notif::error(T_("We can not renew this domain because the bill holder of IRNIC can not access to renew"));
		// 	return false;
		// }

		$domain_action_detail =
		[
			'domain_id' => $domain_id,
			'period'    => $period_month,
		];

		\lib\app\nic_domainaction\action::set('domain_renew_ready', $domain_action_detail);

		$user_budget = \dash\user::budget();

		if($user_budget >= $price)
		{
			$insert_transaction =
			[
				'user_id' => \dash\user::id(),
				'title'   => T_("Renew domian :val", ['val' => $domain]),
				'verify'  => 1,
				'minus'   => $price,
				'type'    => 'money',
			];

			$transaction_id = \dash\db\transactions::set($insert_transaction);
			if(!$transaction_id)
			{
				\dash\notif::error(T_("No way to insert data"));
				return false;
			}

			// insert price domain log table
		}
		else
		{
			$temp_args = $_args;

			// go to bank
			$meta =
			[
				'msg_go'        => T_("Renew :domain For :year year", ['domain' => $domain, 'year' => \dash\fit::number(round($period_month / 12))]),
				'auto_go'       => false,
				'auto_back'     => true,
				'final_msg'     => true,
				'turn_back'     => \dash\url::kingdom(). '/my/domain',
				'user_id'       => \dash\user::id(),
				'amount'        => abs($price),
				'final_fn'      => ['/lib/app/nic_domain/renew', 'renew'],
				'final_fn_args' => $temp_args,
			];

			$result_pay = \dash\utility\pay\start::api($meta);

			if(isset($result_pay['url']) && isset($result_pay['transaction_id']))
			{
				$domain_action_detail =
				[
					'transaction_id' => \dash\coding::decode($result_pay['transaction_id']),
					'domain_id'      => $domain_id,
					'detail'         => json_encode(['pay_link' => $result_pay['url']], JSON_UNESCAPED_UNICODE),
				];

				\lib\app\nic_domainaction\action::set('domain_renew_pay_link', $domain_action_detail);

				if(\dash\engine\content::api_content())
				{
					$msg = T_("Pay link :val", ['val' => $result_pay['url']]);
					\dash\notif::meta($result_pay);
					\dash\notif::ok($msg);
					return;
				}
				else
				{
					\dash\redirect::to($result_pay['url']);
				}
			}
			else
			{
				\dash\log::oops('generate_pay_error');
				return false;
			}


			// redirect to bank payment
			return ;

		}


		$ready =
		[
			'domain'             => $domain,
			'period'             => $period_month,
			'expiredate'         => $expiredate,
			'current_expiredate' => $current_expiredate,

		];

		$result = \lib\nic\exec\domain_renew::renew($ready);

		\dash\temp::set('domain_code_url', \dash\coding::encode($domain_id));
		\dash\temp::set('need_show_domain_result', true);

		if($result && $domain_id)
		{
			$update               = [];
			$update['dateexpire'] = $expiredate;
			$update['status']     = 'enable';

			\lib\app\domains\detect::domain('renew', $domain);


			\lib\db\nic_domain\update::update($update, $domain_id);


			$domain_action_detail =
			[
				'domain_id'      => $domain_id,
				'price'          => $price,
				'transaction_id' => $transaction_id,
				'period'         => $period_month,
			];

			\lib\app\nic_domainaction\action::set('renew', $domain_action_detail);

			$insert_billing =
			[
				'domain_id'      => $domain_id,
				'user_id'        => \dash\user::id(),
				'action'         => 'renew',
				'status'         => 'enable',
				'mode'           => 'manual',
				'price'          => $price,
				'period'         => $period_month,
				'transaction_id' => $transaction_id,
				'detail'         => null,
				'date'           => date("Y-m-d H:i:s"),
				'datecreated'    => date("Y-m-d H:i:s"),
			];

			$domain_action_id = \lib\db\nic_domainbilling\insert::new_record($insert_billing);



			\dash\notif::ok(T_("Domain renew ok"), ['alerty' => true]);
			return true;

		}
		else
		{
			// need to back money
			$insert_transaction =
			[
				'user_id' => \dash\user::id(),
				'title'   => T_("Renew failed :val", ['val' => $domain]),
				'verify'  => 1,
				'plus'    => $price,
				'type'    => 'money',
			];

			$transaction_id = \dash\db\transactions::set($insert_transaction);
			if(!$transaction_id)
			{
				\dash\notif::error(T_("No way to insert data"));
				return false;
			}

			$domain_action_detail =
			[
				'domain_id'      => $domain_id,
				'price'          => $price,
				'period'         => $period_month,
				'transaction_id' => $transaction_id,
			];

			\lib\app\nic_domainaction\action::set('renew_faled', $domain_action_detail);


			\dash\temp::set('domainHaveTransaction', true);

			\dash\notif::error(T_("Can not renew your domain"));
			return false;
		}



	}
}
?>