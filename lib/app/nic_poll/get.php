<?php
namespace lib\app\nic_poll;


class get
{
	public static function cronjob_list()
	{
		$poll = \lib\nic\exec\poll::request();

		if(isset($poll['count']) && is_numeric($poll['count']) && intval($poll['count']) > 0)
		{
			$count = intval($poll['count']);

			// fetch nic credit after have a poll request
			\lib\app\nic_credit\get::fetch();

			for ($i=1; $i <= $count ; $i++)
			{
				if(isset($poll['id']))
				{
					$insert =
					[
						'notif_count' => isset($poll['count']) ? $poll['count'] : null,
						'server_id'   => isset($poll['id']) ? $poll['id'] : null,
						'index'       => isset($poll['index']) ? $poll['index'] : null,
						'note'        => isset($poll['note']) ? $poll['note'] : null,
						'domain'      => isset($poll['domain']) ? $poll['domain'] : null,
						'detail'      => isset($poll['detail']) ? json_encode($poll['detail'], JSON_UNESCAPED_UNICODE) : null,
						'datecreated' => date("Y-m-d H:i:s"),
					];

					$poll_id = \lib\db\nic_poll\insert::new_record($insert);
					if($poll_id)
					{
						if(isset($insert['domain']) && $insert['domain'])
						{
							\lib\app\domains\detect::domain('poll', $insert['domain']);

							\lib\db\nic_domain\update::remove_lastfetch_domain($insert['domain']);

							\lib\app\nic_domain\get::force_fetch($insert['domain']);

							$get_domain = \lib\db\nic_domain\get::who_verify_enable_domain($insert['domain']);

							if(isset($get_domain['user_id']))
							{
								$log_meta =
								[
									'to'       => $get_domain['user_id'],
									'mydomain' => $insert['domain'],
								];

								if(isset($poll['detail'][$insert['domain']]['status']) && is_array($poll['detail'][$insert['domain']]['status']))
								{
									if(in_array('irnicRegistrationApproved', $poll['detail'][$insert['domain']]['status']))
									{
										$log_meta['domainstatus'] = 'approved';

										// load domain to add in business_domain list
										\lib\app\business_domain\add::from_domain_approved($insert['domain']);
									}
									elseif
									(
										in_array('irnicRegistrationRejected', $poll['detail'][$insert['domain']]['status']) ||
										(
											in_array('inactive', $poll['detail'][$insert['domain']]['status']) &&
											in_array('irnicSuspended', $poll['detail'][$insert['domain']]['status'])
										)
									)
									{
										$log_meta['domainstatus'] = 'rejected';
										// @reza need to check if pay money and back it
										self::back_money($insert['domain']);
									}
									else
									{
										$log_meta['domainstatus'] = null;
									}
								}


								\dash\log::set('domain_irnicChangeStatus', $log_meta);

							}

							if(isset($get_domain['id']))
							{

								// save action
								$domain_action_detail =
								[
									'domain_id' => $get_domain['id'],
									'mode'      => 'auto',
									'category'  => 'irnic',
									'detail'    => $insert['detail'],
								];

								\lib\app\nic_domainaction\action::set($insert['index'], $domain_action_detail);
							}
						}

						$set_as_acknowledge = \lib\nic\exec\poll::acknowledge($poll['id']);
						if($set_as_acknowledge)
						{
							\lib\db\nic_poll\update::update(['acknowledge' => 1], $poll_id);
						}
					}
				}
				else
				{
					break;
				}

				$poll = \lib\nic\exec\poll::request();

			}
		}
		return $poll;

	}


	private static function back_money($_domain)
	{
		$result = \lib\db\nic_domainbilling\get::register_price_back($_domain);
		if(!is_array($result))
		{
			return false;
		}

		if(count($result) > 1)
		{
			\dash\log::to_supervisor('Domain reject money back. More than one register record founded. domain: '. $_domain);
			return false;
		}

		$result = a($result, 0);

		if(a($result, 'user_id') && a($result, 'finalprice') && is_numeric($result['finalprice']) && !a($result, 'giftusage_id'))
		{
			$insert_transaction =
			[
				'user_id' => $result['user_id'],
				'title'   => T_("Refund money for reject domain :val", ['val' => $_domain]),
				'verify'  => 1,
				'plus'    => floatval($result['finalprice']),
				'type'    => 'money',
			];

			$transaction_id = \dash\db\transactions::set($insert_transaction);

			\dash\log::set('domain_irnicRefundMoney', ['to' => $result['user_id'], 'mydomain' => $_domain]);

			\dash\log::to_supervisor('Domain reject money back. Refund money successfull. domain: '. $_domain);

		}
		// check domain only for one user
		// if this domain founded in more than one user accoutn check who pay for this domain
		// if more than one person pay for this domain set log and return
		// check domain pay money
		// refund money paid

	}


	public static function list()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		return self::cronjob_list();
	}



	public static function my_list()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$list = \lib\db\nic_poll\get::my_list(\dash\user::id());

		if(is_array($list))
		{
			foreach ($list as $key => $value)
			{
				unset($list[$key]['id']);
				unset($list[$key]['server_id']);
				unset($list[$key]['notif_count']);
				unset($list[$key]['detail']);

				if(isset($value['index']))
				{
					switch ($value['index'])
					{
						case 'DomainUpdateStatus':
							$list[$key]['taction'] = T_("Your domain status was updated");
							$list[$key]['class']   = '';
							$list[$key]['meta']   = $value['domain'];
							$list[$key]['icon']    = '<i class="sf-refresh fc-blue"></i>';
							break;

						// case 'DomainUpdateStatus DomainNotice':
						// 	break
						default:
							$list[$key]['taction'] = $value['index'];
							break;
					}
				}
			}
		}
		else
		{
			$list = [];
		}

		return $list;
	}
}
?>