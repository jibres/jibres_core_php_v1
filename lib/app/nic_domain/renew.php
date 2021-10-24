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
		$period_year  = 0;

		if($period === '1year')
		{
			$period_month = 12;
			$period_year  = 1;

		}
		elseif($period === '5year')
		{
			$period_month = 5*12;
			$period_year  = 5;
		}

		$domain_id = null;

		\lib\app\domains\detect::domain('start_renew', $domain);


		$load_domain = \lib\db\nic_domain\get::domain_user($domain, $user_id);
		if(isset($load_domain['id']))
		{
			$domain_id = $load_domain['id'];

			if(isset($load_domain['status']) && $load_domain['status'] === 'deleted')
			{
				\lib\db\nic_domain\update::update(['status' => 'awaiting'], $domain_id);
			}
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

		$get_domain_info = \lib\app\nic_domain\check::info($domain);

		if(!isset($get_domain_info['exDate']))
		{
			// \dash\notif::error(T_("Domain is not exists"));
			return false;
		}

		if(isset($get_domain_info['status']) && is_array($get_domain_info['status']))
		{
			if(in_array('pendingRenew', $get_domain_info['status']))
			{
				$msg = T_("Domain is pending to renew");
				$msg .= '<br>';
				$msg .= T_("Can not renew again at this time!");

				\dash\notif::error(1,['timeout' => 0, 'alerty' => true, 'html' => $msg]);
				return false;
			}

			if(in_array('serverRenewProhibited', $get_domain_info['status']))
			{
				$msg = T_("Can not renew again at this time!");
				\dash\notif::error(1,['timeout' => 0, 'alerty' => true, 'html' => $msg]);
				return false;
			}
		}

		\lib\db\nic_domain\update::update(['available' => 0], $domain_id);

		$current_expiredate = date("Y-m-d", strtotime($get_domain_info['exDate']));

		$current_date_expire      = $get_domain_info['exDate'];

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

			\dash\notif::error(1,['timeout' => 0, 'alerty' => true, 'html' => $msg]);


			return false;
		}

		$price = \lib\app\nic_domain\price::renew($period, $current_date_expire);

		$reseller = isset($get_domain_info['reseller']) ? $get_domain_info['reseller'] : null;
		$bill     = isset($get_domain_info['bill']) ? $get_domain_info['bill'] : null;

		$jibres_nic_contact = 'ji128-irnic';

		$dont_know_nic_bill = false;

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
			$dont_know_nic_bill = true;
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

			if($dont_know_nic_bill)
			{
				$domain_action_detail['detail'] = json_encode(['renew_price' => $price, 'current_date_expire' => $current_date_expire, 'dont_know_nic_bill' => true, 'must_set_reseller' => $reseller === $jibres_nic_contact ? true : false]);
			}
			else
			{
				$domain_action_detail['detail'] = json_encode(['renew_price' => $price, 'current_date_expire' => $current_date_expire]);
			}

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
				'domain'        => $domain,
				'domain_period' => $period_year,
				'code'          => $data['gift'],
				'price'         => $price,
				'user_id'       => $user_id,
				'usein'         => 'domain',
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
			$pay_amount_bank   = 0;
			$pay_amount_budget = 0;

			if($remain_amount <= 0)
			{
				// all price minus by gift card
			}
			else
			{
				$user_budget = floatval(\dash\app\transaction\budget::user($user_id));

				if($data['usebudget'] && $user_budget)
				{
					$pay_amount_budget = $remain_amount;

					$data['minus_transaction'] = $remain_amount;

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
				$temp_args['agree']             = true;
				$temp_args['register_now']      = true;
				// $temp_args['discount']       = $discount;
				$temp_args['minus_transaction'] = $pay_amount_budget + $pay_amount_bank;
				$temp_args['user_id']           = $user_id;


				// go to bank
				$meta =
				[
					'msg_go'        => T_("Renew :domain For :year year", ['domain' => $domain, 'year' => \dash\fit::number(round($period_month / 12))]),
					'auto_go'       => false,
					'auto_back'     => true,
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

					if(\dash\url::is_api())
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


		if($data['minus_transaction'])
		{
			\dash\db::transaction();
			// check budget
			$user_budget = \dash\app\transaction\budget::get_and_lock($user_id);

			if($user_budget < floatval($data['minus_transaction']))
			{
				\dash\notif::error(T_("Your budget is low!"));
				\dash\db::rollback();
				return false;
			}

			$insert_transaction =
			[
				'user_id' => $user_id,
				'title'   => T_("Renew domian :val", ['val' => $domain]),
				'amount'  => floatval($data['minus_transaction']),
			];

			$transaction_id = \dash\app\transaction\budget::minus($insert_transaction);

			\dash\db::commit();

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

		$result = \lib\api\nic\exec\domain_renew::renew($ready);

		\dash\temp::set('domain_code_url', \dash\coding::encode($domain_id));
		\dash\temp::set('domain_name_url', $domain);

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
				'renewnotif' => null,
				'renewtry'   => null,
			];

			\lib\db\nic_domain\update::update($update, $domain_id);




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
				'detail'         => json_encode(['old_expire_date' => $current_expiredate], JSON_UNESCAPED_UNICODE),
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


			$msg = T_("Domain :domain was renewed", ['domain' => $domain]);
			$msg .= '<br>';
			$msg .= T_("Domain date expire:");
			$msg .= '<br>';
			$msg .= \dash\fit::date($expiredate);

			\dash\notif::ok(1,['timeout' => 0, 'alerty' => true, 'html' => $msg]);

			// fetch nic credit after renew domain
			\lib\app\nic_credit\get::fetch();

			\dash\log::set('domain_newRegister', ['my_domain' => $domain, 'my_period' => $period_month, 'my_type' => 'renew', 'my_giftusage_id' => $gift_usage_id, 'my_finalprice' => $finalprice]);

			// \dash\notif::ok(, ['alerty' => true]);

			\lib\app\nic_domain\edit::remove_last_fetch(\dash\coding::encode($domain_id));

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

			\lib\app\nic_domainaction\action::set('renew_failed', $domain_action_detail);

			\dash\log::to_supervisor('failed to renew domain '. $domain);

			\dash\temp::set('domainHaveTransaction', true);


			if($data['minus_transaction'])
			{

				$insert_transaction =
				[
					'user_id' => $user_id,
					'title'   => T_("Back money for cancel renew domian :val", ['val' => $domain]),
					'amount'  => floatval($data['minus_transaction']),

				];

				$transaction_id = \dash\app\transaction\budget::plus($insert_transaction);

				if(!$transaction_id)
				{
					\dash\log::oops('transaction_db');
					return false;
				}
			}


			$msg = T_("We can not renew this domain because the bill holder of IRNIC can not access to renew");
			$msg .= '<br>';
			$msg .= T_("If you are administrator of this domain Your must go to nic.ir and set billing holder of this domain on 'ji128-irnic' ");
			$msg .= '<br>';
			$msg .= T_("After change this problem you can try again");
			$msg .= '<br>';
			$msg .= T_("If you pay any amount, Your amount is saved in your account");
			$msg .= '<br>';

			if($data['gift'])
			{
				$msg .= T_("Don't worry! Your gift is ok and not used. You can use it again");
				$msg .= '<br>';
			}


			\dash\notif::error(1,['target1' => '#myidx', 'timeout' => 0, 'alerty' => true, 'html' => $msg]);
			return false;
		}
	}
}
?>