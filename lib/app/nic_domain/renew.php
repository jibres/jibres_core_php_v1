<?php
namespace lib\app\nic_domain;


class renew
{
	public static function renew($_args)
	{

		$condition =
		[
			'domain'            => 'ir_domain',
			'agree'             => 'bit',
			'period'            => ['enum' => ['1year', '5year']],
			'register_now'      => 'bit',
			'gift'              => 'string_100',
			'usebudget'         => 'bit',
			'discount'          => 'price',
			'pay_amount_bank'   => 'price',
			'pay_amount_budget' => 'price',
			'minus_transaction' => 'price',
			'after_pay'         => 'bit',
			'user_id'           => 'id',
			'admin_renew_force' => 'bit',
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

		\dash\temp::set('ji128-irnic-not-allow', null);

		// after pay get user id from args
		$user_id = $data['user_id'];

		if(!$user_id)
		{
			$user_id = \dash\user::id();
		}

		if(!$user_id)
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

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


		$load_domain = \lib\db\nic_domain\get::domain_user($domain, $user_id);
		if(isset($load_domain['id']))
		{
			$domain_id = $load_domain['id'];
		}
		else
		{
			$insert =
			[
				'user_id'      => $user_id,
				'name'         => $domain,
				'registrar'    => 'irnic',
				'status'       => 'awaiting',
				'holder'       => null,
				'admin'        => null,
				'tech'         => null,
				'bill'         => null,
				'autorenew'    => null,
				'lock'         => null,
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

		\lib\db\nic_domain\update::update(['available' => 0], $domain_id);

		$current_expiredate = date("Y-m-d", strtotime($get_domain_detail['exDate']));

		$current_date_expire      = $get_domain_detail['exDate'];

		$current_date_expire_time = strtotime($current_date_expire);

		$new_date_expire          = ($period_month * 30*24*60*60);

		$new_date_expire          = $current_date_expire_time + $new_date_expire;

		$expiredate               = date("Y-m-d", $new_date_expire);

		$year_6 = time() + (60*60*24*365*6);

		if($new_date_expire >= $year_6)
		{
			$msg = T_("The domain expire time is :date", ['date' => \dash\fit::date($current_expiredate)]);
			$msg .= '<br>';
			$msg .= T_("You try to renew this domain for :val years", ['val' => \dash\fit::number(substr($period, 0, 1))]);
			$msg .= '<br>';
			$msg .= T_("Because the maximum validity period of the domain is six years, and depending on the period you choose and the expiration date of the domain, your domain will be more than six years, and this is not possible.");
			$msg .= '<br>';
			$msg .= '<a href="'.\dash\url::support().'/domain" target="_blank">'. T_("Read about this problem"). '</a>';

			\dash\notif::error(1,['timeout' => 0, 'alerty' => true, 'html' => $msg]);


			return false;
		}

		$reseller = isset($get_domain_detail['reseller']) ? $get_domain_detail['reseller'] : null;
		$bill     = isset($get_domain_detail['bill']) ? $get_domain_detail['bill'] : null;

		$jibres_nic_contact = 'ji128-irnic';


		if($reseller === $jibres_nic_contact)
		{
			// is ok
		}
		elseif($bill === $jibres_nic_contact)
		{
			// is ok
		}
		elseif($bill === null)
		{
			// Don't know
			// Buy from nic.ir and set bill on jibres. for example rezamohiti.ir
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


		// -------------------------------------------------- Check to redirec to review or register now ---------------------------------------------- //
		if(!$data['register_now'])
		{

			$domain_action_detail =
			[
				'domain_id' => $domain_id,
				'period'    => $period_month,
			];

			\lib\app\nic_domainaction\action::set('domain_renew_ready', $domain_action_detail);

			$result              = [];
			$result['domain_id'] = \dash\coding::encode($domain_id);

			\dash\notif::ok(T_("Domain ready to renew"));
			return $result;
		}


		// check gift card
		$remain_amount     = $price;
		$discount          = 0;

		if($data['gift'])
		{
			$gift_args =
			[
				'code'    => $data['gift'],
				'price'   => $price,
				'user_id' => $user_id,
				'usein'   => 'domain',
			];

			$gift_detail = \lib\app\gift\check::check($gift_args);

			if(!\dash\engine\process::status())
			{
				return false;
			}

			$discount      = $gift_detail['discount'];
			$remain_amount = $remain_amount - floatval($discount);
		}


		// this code just run before pay
		if(!$data['after_pay'])
		{
			$minus_transaction = 0;
			$pay_amount_bank   = 0;
			$pay_amount_budget = 0;

			if($remain_amount <= 0)
			{
				// all price minus by gift card
			}
			else
			{
				$user_budget = floatval(\dash\db\transactions::budget($user_id));

				if($data['usebudget'] && $user_budget)
				{
					$pay_amount_budget = $remain_amount;

					$minus_transaction = $remain_amount;

					$remain_amount = floatval($remain_amount) - floatval($user_budget);

				}
				else
				{
					$pay_amount_bank                = $remain_amount;
				}
			}

			if($remain_amount > 0)
			{

				$temp_args                      = $data;
				$temp_args['pay_amount_bank']   = $pay_amount_bank;
				$temp_args['pay_amount_budget'] = $pay_amount_budget;
				$temp_args['after_pay']         = true;
				// $temp_args['discount']          = $discount;
				$temp_args['minus_transaction'] = $pay_amount_budget + $pay_amount_bank;
				$temp_args['user_id']           = $user_id;


				// go to bank
				$meta =
				[
					'msg_go'        => T_("Renew :domain For :year year", ['domain' => $domain, 'year' => \dash\fit::number(round($period_month / 12))]),
					'auto_go'       => false,
					'auto_back'     => false,
					'final_msg'     => true,
					'turn_back'     => \dash\url::kingdom(). '/my/domain',
					'user_id'       => $user_id,
					'amount'        => abs($remain_amount),
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
						'period'         => $period_month,
						'detail'         => json_encode(['pay_link' => $result_pay['url']], JSON_UNESCAPED_UNICODE),
					];

					\lib\app\nic_domainaction\action::set('domain_renew_pay_link', $domain_action_detail);

					if(\dash\engine\content::api_content())
					{
						$msg = T_("Pay link :val", ['val' => $result_pay['url']]);
						\dash\notif::meta($result_pay);
						\dash\notif::ok($msg);
						return null;
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
				return null;
			}
		}


		$ready =
		[
			'domain'             => $domain,
			'period'             => $period_month,
			'expiredate'         => $expiredate,
			'current_expiredate' => $current_expiredate,

		];

		$finalprice = floatval($price) - floatval($discount);
		$gift_usage_id = null;

		$result = \lib\nic\exec\domain_renew::renew($ready);

		\dash\temp::set('domain_code_url', \dash\coding::encode($domain_id));
		\dash\temp::set('need_show_domain_result', true);

		if($result && $domain_id)
		{

			\lib\app\domains\detect::domain('renew', $domain);

			$update =
			[
				'status'     => 'enable',
				'gateway'    => null,
				'available'  => 0,
				'dateexpire' => $expiredate,
			];

			\lib\db\nic_domain\update::update($update, $domain_id);

			if($data['minus_transaction'])
			{

				$insert_transaction =
				[
					'user_id' => $user_id,
					'title'   => T_("Renew domian :val", ['val' => $domain]),
					'verify'  => 1,
					'minus'   => floatval($data['minus_transaction']),
					'type'    => 'money',
				];

				$transaction_id = \dash\db\transactions::set($insert_transaction);

				if(!$transaction_id)
				{
					\dash\log::oops('transaction_db');
					return false;
				}
			}


			if($data['gift'])
			{
				$gift_meta =
				[
					'code'            => $data['gift'],
					'transaction_id'  => $transaction_id,
					'price'           => $price,
					'discount'        => $discount,
					'discountpercent' => round((floatval($discount) * 100) / floatval($price)),
					'finalprice'      => $finalprice,
					'user_id'         => $user_id,
				];

				$gift_usage_id = \lib\app\gift\usage::set($gift_meta);
			}


			$domain_action_detail =
			[
				'domain_id'      => $domain_id,
				'price'          => $price,
				'period'         => $period_month,
				'discount'       => $discount,
				'finalprice'     => $finalprice,
				'transaction_id' => $transaction_id,
				'giftusage_id'   => $gift_usage_id,
			];

			\lib\app\nic_domainaction\action::set('renew', $domain_action_detail);

			$insert_billing =
			[
				'domain_id'      => $domain_id,
				'user_id'        => $user_id,
				'action'         => 'renew',
				'status'         => 'enable',
				'mode'           => 'manual',
				'period'         => $period_month,
				'price'          => $price,
				'discount'       => $discount,
				'finalprice'     => $finalprice,
				'transaction_id' => $transaction_id,
				'detail'         => null,
				'date'           => date("Y-m-d H:i:s"),
				'datecreated'    => date("Y-m-d H:i:s"),
				'giftusage_id'   => $gift_usage_id,
			];

			$domain_action_id = \lib\db\nic_domainbilling\insert::new_record($insert_billing);

			\dash\notif::ok(T_("Domain :domain was renewed", ['domain' => $domain]), ['alerty' => true]);


			return true;

		}
		else
		{

			$domain_action_detail =
			[
				'domain_id'      => $domain_id,
				// 'price'          => $price,
				'period'         => $period_month,
				'transaction_id' => $transaction_id,
			];

			\lib\app\nic_domainaction\action::set('renew_faled', $domain_action_detail);


			\dash\temp::set('domainHaveTransaction', true);

			$msg = T_("We can not renew this domain because the bill holder of IRNIC can not access to renew");
			$msg .= '<br>';
			$msg .= T_("If you are administrator of this domain Your must go to nic.ir and set billing holder of this domain on 'ji128-irnic' ");
			$msg .= '<br>';
			$msg .= T_("After change this problem you can try again");
			$msg .= '<br>';
			$msg .= T_("If you yor pay any amount, Your amount is saved in your account");
			$msg .= '<br>';

			if($data['gift'])
			{
				$msg .= T_("Don't worry! Your gift is ok and not used. You can use it again");
				$msg .= '<br>';
			}

			$msg .= '<a href="'.\dash\url::support().'/domain" target="_blank">'. T_("Read about this problem"). '</a>';

			\dash\notif::error(1,['target1' => '#myidx', 'timeout' => 0, 'alerty' => true, 'html' => $msg]);
			return false;
		}
	}
}
?>