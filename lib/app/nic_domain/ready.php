<?php
namespace lib\app\nic_domain;


class ready
{

	public static function row($_data)
	{
		$domain = isset($_data['name']) ? $_data['name'] : null;

		// disableDomainFetch set in admin panel of supervisor
		// the supervisor load many domain and needless to fetch all domain

		// if($domain && !\dash\temp::get('disableDomainFetch'))
		// {
		// 	// only enable domain fetch & update result
		// 	if(isset($_data['status']) && ($_data['status'] === 'enable' || $_data['status'] === 'awaiting'))
		// 	{
		// 		if(isset($_data['lastfetch']) && $_data['lastfetch'])
		// 		{
		// 			// fetch every 1 hour
		// 			if(time() - strtotime($_data['lastfetch']) > (60*60*24*7))
		// 			{
		// 				\lib\app\nic_domain\get::update_fetch($domain, $_data);
		// 				$_data = \lib\db\nic_domain\get::by_id($_data['id']);
		// 			}
		// 		}
		// 		else
		// 		{
		// 			\lib\app\nic_domain\get::update_fetch($domain, $_data);
		// 			$_data = \lib\db\nic_domain\get::by_id($_data['id']);
		// 		}
		// 	}

		// }

		$result = [];

		if(!is_array($_data))
		{
			$_data = [];
		}

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'nicstatus':
					if(\dash\url::content() === 'hook' || \dash\url::content() === 'love')
					{
						$result[$key] = $value;
						if($value && is_string($value))
						{
							$result['nicstatus_array'] = json_decode($value, true);
						}
					}

					$status_html = '<div class="ibtn x30 wide"><span>'.T_("Unknown").'</span><i class="sf-question"></i></div>';
					if($value && is_string($value))
					{
						$nicstatus = json_decode($value, true);
						if(!is_array($nicstatus))
						{
							$nicstatus = [];
						}
						// -------------------------------- NIC HOLDER STATUS LIST
						// ok 						-- OK
						// pendingUpdate 			-- PENDING TO UPDAT EHOLDER
						// serverDeleteProhibited 	-- NO WAY TO DELETE HOLDER
						// serverUpdateProhibited 	-- NO WAY TO UPDATE HOLDER
						// irnicUnapproved 			-- UNAPPROVED THE ADDRESS OF HOLDER
						// irnicApproved 			-- APPROVED THE ADDRESS OF HOLDER
						// irnicQueued 				-- WAITING TO APPROVE ADDRESS
						// irnicRejected 			-- REJECT NIC HOLDER
						// irnicLimited 			-- CAN NOT CHOOSE THIS HOLDER


						// -------------------------------- NIC DOMAIN STATUS LIST
						// Ok
						// serverHold 									-- DOMAIN RESERVED
						// inactive 									-- DOMAIN IS LOCK OR EXPIRE ( IS NOT ENABLE )
						// irnicReserved
						// serverRenewProhibited
						// irnicRegistrationPendingDomainCheck
						// irnicRegistrationRejected
						// pendingDelete
						// pendingRenew
						// pendingUpdate
						// irnicRegistered
						// irnicLocked
						// irnicExpired
						// irnicRegistrationApproved
						// irnicRegistrationRejected
						// irnicRegistrationPendingHolderCheck
						// irnicRegistrationPendingDomainCheck
						// irnicRegistrationDocRequired
						// irnicRegistrationIsWithdrawn
						// irnicRenewalApproved
						// irnicRenewalRejected
						// irnicRenewalPendingHolderCheck
						// irnicRenewalPendingDomainCheck
						// irnicRenewalDocRequired
						// irnicRenewalIsWithdrawn
						// irnicHolderChangeApproved
						// irnicHolderChangeRejected
						// irnicHolderChangePendingHolderCheck
						// irnicHolderChangePendingDomainCheck
						// irnicHolderChangeDocRequired
						// irnicHolderChangeIsWithdrawn
						// irnicDeletionApproved
						// irnicDeletionRejected
						// irnicDeletionPendingHolderCheck
						// irnicDeletionPendingDomainCheck
						// irnicDeletionDocRequired
						// irnicDeletionIsWithdrawn

						$result['can_renew'] = true;
						if(in_array('serverRenewProhibited', $nicstatus))
						{
							$result['can_renew'] = false;
						}

						$other_status = $nicstatus;

						if(in_array('irnicRegistrationRejected', $nicstatus))
						{
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Reject").'</span><i class="sf-times fc-red"></i></div>';
							unset($other_status[array_search('irnicRegistrationRejected', $other_status)]);
						}

						if(in_array('irnicRegistrationPendingDomainCheck', $nicstatus))
						{
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Pending Approved").'</span><i class="sf-refresh fc-blue"></i></div>';
							unset($other_status[array_search('irnicRegistrationPendingDomainCheck', $other_status)]);
						}

						if(in_array('ok', $nicstatus))
						{
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Enable").'</span><i class="sf-check fc-green"></i></div>';
							unset($other_status[array_search('ok', $other_status)]);
						}

						if(in_array('irnicRegistered', $nicstatus))
						{
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Enable").'</span><i class="sf-check fc-green"></i></div>';
							unset($other_status[array_search('irnicRegistered', $other_status)]);
						}

						if(in_array('irnicLocked', $nicstatus))
						{
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Locked").'</span><i class="sf-lock fc-red"></i></div>';
							unset($other_status[array_search('irnicLocked', $other_status)]);
						}


						if(in_array('irnicExpired', $nicstatus))
						{
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Expired").'</span><i class="sf-times fc-yellow"></i></div>';
							unset($other_status[array_search('irnicExpired', $other_status)]);
						}


						if(in_array('irnicRegistrationDocRequired', $nicstatus))
						{
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Document required").'</span><i class="sf-info-circle fc-yellow"></i></div>';
							unset($other_status[array_search('irnicRegistrationDocRequired', $other_status)]);
						}

						if(in_array('irnicRegistrationApproved', $nicstatus))
						{
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Register Approved").'</span><i class="sf-check fc-green"></i></div>';
							unset($other_status[array_search('irnicRegistrationApproved', $other_status)]);
						}


						if(
							in_array('serverHold', 					$nicstatus) &&
							in_array('irnicReserved', 				$nicstatus) &&
							in_array('serverRenewProhibited', 		$nicstatus) &&
							in_array('serverDeleteProhibited', 		$nicstatus) &&
							in_array('irnicRegistrationApproved', 	$nicstatus)
						  )
						{
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Domain reserved").'</span><i class="sf-info-circle fc-blue"></i></div>';
						}


						$other_status_html = '';

						if($other_status)
						{
							foreach ($other_status as $v)
							{
								$other_status_html.= '<span class="badge light" title="'. $v. '">'. T_($v). '</span>';
							}
						}

						$result['other_status'] = $other_status_html;
					}

					$result['status_html'] = $status_html;

					break;

				case 'id':
				case 'dns':
					$result[$key] = \dash\coding::encode($value);
					break;

				case 'user_id':
				case 'result':
					if(\dash\url::content() === 'hook' || \dash\url::content() === 'love')
					{
						$result[$key] = $value;
					}
					break;

				case 'status':
					$result[$key] = $value;
					$result['tstatus'] = T_($value);
					break;

				case 'verify':
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}


		/**
		 * set verify user by check mobile and email
		 */
		if(array_key_exists('verify', $result) && !$result['verify'])
		{
			if(\dash\url::content() === 'my')
			{
				$mobile = null;
				if(\dash\user::detail('verifymobile'))
				{
					$mobile = \dash\user::detail('mobile');
					if(isset($result['mobile']) && $result['mobile'] === $mobile)
					{
						$result['verify'] = 1;
					}
				}


				$have_emails = \dash\user::email_list(true);

				if($have_emails && is_array($have_emails))
				{
					if(isset($result['email']) && in_array($result['email'], $have_emails))
					{
						$result['verify'] = 1;
					}
				}
			}

		}


		$result['jibres_dns'] = false;
		if(isset($result['available']) && $result['available'] === '1')
		{
			$new_result = [];
			$new_result['name'] = $result['name'];
			$status_html =  '<a href="'.\dash\url::this(). '/buy/'. $result['name'].'"><div class="ibtn x30 wide"><span>'. T_("Register now").'</span><i class="sf-shop fc-green"></i></div></a>';
			$new_result['status_html'] = $status_html;

			if(\dash\url::content() !== 'love')
			{
				$result = $new_result;
			}
		}

		if(isset($result['ns1']) && isset($result['ns2']) && $result['ns1'] && $result['ns2'])
		{
			$check_dns = [$result['ns1'], $result['ns2']];

			$arvan_ns1 = \lib\app\nic_usersetting\defaultval::ns1();
			$arvan_ns2 = \lib\app\nic_usersetting\defaultval::ns2();

			if(in_array($arvan_ns1, $check_dns) && in_array($arvan_ns2, $check_dns))
			{
				$result['jibres_dns'] = true;
			}
		}

		if(isset($result['registrar']) && $result['registrar'] !== 'irnic')
		{
			$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Enable").'</span><i class="sf-check fc-green"></i></div>';
			$result['status_html'] = $status_html;
		}

		return $result;
	}


	public static function is_verify($_detail)
	{
		$detail = self::row($_detail);
		if(isset($detail['verify']) && $detail['verify'])
		{
			return true;
		}

		return false;
	}
}
?>