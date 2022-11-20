<?php
namespace lib\app\nic_domain;


class ready
{

	public static function row($_data)
	{
		$domain = isset($_data['name']) ? $_data['name'] : null;

		// disableDomainFetch set in admin panel of supervisor
		// the supervisor load many domain and needless to fetch all domain

		if($domain && !\dash\temp::get('disableDomainFetch'))
		{
			if(\dash\url::is_api())
			{
				\lib\app\nic_domain\get::update_fetch($domain, $_data);
				$_data = \lib\db\nic_domain\get::by_id($_data['id']);
			}
			// only enable domain fetch & update result
			// if(isset($_data['status']) && ($_data['status'] === 'enable' || $_data['status'] === 'awaiting'))
			// {
			// 	if(isset($_data['lastfetch']) && $_data['lastfetch'])
			// 	{
			// 		// fetch every 1 hour
			// 		if(time() - strtotime($_data['lastfetch']) > (60*60*24*7))
			// 		{
			// 			\lib\app\nic_domain\get::update_fetch($domain, $_data);
			// 			$_data = \lib\db\nic_domain\get::by_id($_data['id']);
			// 		}
			// 	}
			// 	else
			// 	{
			// 		\lib\app\nic_domain\get::update_fetch($domain, $_data);
			// 		$_data = \lib\db\nic_domain\get::by_id($_data['id']);
			// 	}
			// }

		}

		$result = [];

		$all_holder = [];

		if(!is_array($_data))
		{
			$_data = [];
		}

		$result['can_renew'] = true;

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
					$status_text = T_("Unknown");
					$status_icon = 'info';
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
						// irnicLocked									-- Domain locked need to unlock pay
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


						if(in_array('serverRenewProhibited', $nicstatus))
						{
							$result['can_renew'] = false;
						}

						$other_status = $nicstatus;

						if(in_array('irnicRegistrationRejected', $nicstatus))
						{
							$status_text = T_("Reject");
							$status_icon = 'times nok';

							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Reject").'</span><i class="sf-times text-red-800"></i></div>';
							unset($other_status[array_search('irnicRegistrationRejected', $other_status)]);
						}

						if(in_array('irnicRegistrationPendingDomainCheck', $nicstatus))
						{
							$status_text = T_("Pending Approved");
							$status_icon = 'detail';
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Pending Approved").'</span><i class="sf-refresh fc-blue"></i></div>';
							unset($other_status[array_search('irnicRegistrationPendingDomainCheck', $other_status)]);
						}

						if(in_array('ok', $nicstatus))
						{
							$status_text = T_("Enable");
							$status_icon = 'check ok';
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Enable").'</span><i class="sf-check fc-green"></i></div>';
							unset($other_status[array_search('ok', $other_status)]);
						}

						if(in_array('irnicRegistered', $nicstatus))
						{
							$status_text = T_("Enable");
							$status_icon = 'check ok';
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Enable").'</span><i class="sf-check fc-green"></i></div>';
							unset($other_status[array_search('irnicRegistered', $other_status)]);
						}

						if(in_array('irnicLocked', $nicstatus))
						{
							$status_text = T_("Locked");
							$status_icon = 'detail nok';
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Locked").'</span><i class="sf-lock text-red-800"></i></div>';
							unset($other_status[array_search('irnicLocked', $other_status)]);
						}


						if(in_array('irnicExpired', $nicstatus))
						{
							$status_text = T_("Expired");
							$status_icon = 'detail nok';
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Expired").'</span><i class="sf-times fc-yellow"></i></div>';
							unset($other_status[array_search('irnicExpired', $other_status)]);
						}


						if(in_array('irnicRegistrationDocRequired', $nicstatus))
						{
							$status_text = T_("Document required");
							$status_icon = 'detail';
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Document required").'</span><i class="sf-info-circle fc-yellow"></i></div>';
							unset($other_status[array_search('irnicRegistrationDocRequired', $other_status)]);
						}

						if(in_array('irnicRegistrationApproved', $nicstatus))
						{
							$status_text = T_("Register Approved");
							$status_icon = 'check';
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
							$status_text = T_("Domain Approved");
							$status_icon = 'detail ok';
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Domain Approved").'</span><i class="sf-info-circle fc-blue"></i></div>';
						}

						if(in_array('irnicRegistrationPendingDomainCheck', $nicstatus) || in_array('irnicRegistrationDocRequired', $nicstatus))
						{
							$result['temp_period'] = 'register';
						}

						if(in_array('pendingRenew', $nicstatus))
						{
							$result['temp_period'] = 'renew';
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

					if(isset($_data['registrar']) && $_data['registrar'] === 'onlinenic')
					{
						$status_text = T_("Enable");
						$status_icon = 'check ok';
						$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Enable").'</span><i class="sf-check fc-green"></i></div>';

					}

					$result['status_text'] = $status_text;
					$result['status_icon'] = $status_icon;
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

				case 'autorenew':
					$result[$key] = $value;

					if((string) $value === '1' || (string) $value === '0')
					{
						$result['autorenewdesign'] = $value;
					}
					else
					{
						if(self::get_my_setting('defaultautorenew'))
						{
							$result['autorenewdesign'] = 1;
						}
						else
						{
							$result['autorenewdesign'] = 0;
						}
					}
					break;

				case 'status':
					$result[$key] = $value;
					$result['tstatus'] = T_($value);
					break;

				case 'verify':
					$result[$key] = $value;
					break;

				case 'reseller':
				case 'bill':
				case 'tech':
				case 'admin':
				case 'holder':
					$all_holder[] = $value;
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}


		if(isset($result['registrar']) && $result['registrar'] === 'irnic')
		{
			$jibres_nic_contact = 'ji128-irnic';
			if(a($result, 'reseller') === $jibres_nic_contact || a($result, 'tech') === $jibres_nic_contact)
			{
				$result['verifychangenameserver'] = true;
				$result['verifychangelock'] = true;
			}

			if(a($result, 'reseller') === $jibres_nic_contact)
			{
				$result['verifychangeholder'] = true;
			}
		}
		else
		{
			$result['verifychangeholder'] = true;
			$result['verifychangelock'] = true;
			$result['verifychangenameserver'] = true;

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

					if(isset($result['email_tech']) && in_array($result['email_tech'], $have_emails))
					{
						$result['verify_tech'] = 1;
					}
				}

				$result['needverifyemail'] = [];

				if(!$result['verify'] && isset($result['email']) && $result['email'])
				{
					if(!in_array($result['email'], $have_emails))
					{
						$result['needverifyemail'][] = $result['email'];
					}
				}

				if(!$result['verify'] && isset($result['email_tech']) && $result['email_tech'])
				{
					if(!in_array($result['email_tech'], $have_emails))
					{
						$result['needverifyemail'][] = $result['email_tech'];
					}
				}

			}

		}

		if(isset($result['dateexpire']) && $result['dateexpire'])
		{
			$max_domain_age = null;

			if(a($result, 'registrar') === 'irnic')
			{
				$max_domain_age = time() + (60*60*24*365*6);
			}
			else
			{
				$max_domain_age = time() + (60*60*24*365*9);
			}

			if($max_domain_age && strtotime($result['dateexpire']) > $max_domain_age)
			{
				$result['can_renew'] = false;
			}

			if(strtotime($result['dateexpire']) < (time() - (60*60*24*31)))
			{
				$result['can_renew'] = false;
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

			if(in_array($arvan_ns1, $check_dns) && in_array($arvan_ns2, $check_dns) && $result['ns1'] !== $result['ns2'])
			{
				$result['jibres_dns'] = true;
			}

			$arvan_ns1 = \lib\app\nic_usersetting\defaultval::ns1_old();
			$arvan_ns2 = \lib\app\nic_usersetting\defaultval::ns2_old();

			if(in_array($arvan_ns1, $check_dns) && in_array($arvan_ns2, $check_dns) && $result['ns1'] !== $result['ns2'])
			{
				$result['jibres_dns'] = true;
			}

		}

		if(isset($result['registrar']) && $result['registrar'] !== 'irnic')
		{
			$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Enable").'</span><i class="sf-check fc-green"></i></div>';
			$result['status_html'] = $status_html;

			if(!a($_data, 'nicstatus'))
			{
				$result['can_renew'] = false;
			}
		}

		if(\dash\temp::get('isApi'))
		{
			unset($result['temp_period']);
			unset($result['verifychangeholder']);
			unset($result['verifychangelock']);
			unset($result['verifychangenameserver']);
			unset($result['autorenewdesign']);
			unset($result['tstatus']);
			unset($result['renewtry']);
			unset($result['renewnotif']);
			unset($result['can_renew']);
			unset($result['other_status']);
			unset($result['status_html']);
			unset($result['lastfetch']);
			unset($result['status_icon']);
			unset($result['ownercheckdate']);
			unset($result['jibres_dns']);
			unset($result['dns']);
			unset($result['nicstatus_array']);
			unset($result['needverifyemail']);
			unset($result['alertholderaccessdeny']);
		}

		return $result;
	}


	private static $get_my_setting = false;
	public static function get_my_setting($_key = null)
	{
		if(self::$get_my_setting === false && \dash\user::id())
		{
			$get_setting = \lib\db\nic_usersetting\get::my_setting(\dash\user::id());
			self::$get_my_setting = $get_setting;
		}

		if($_key)
		{
			if(isset(self::$get_my_setting[$_key]))
			{
				return self::$get_my_setting[$_key];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return self::$get_my_setting;
		}
	}



	public static function is_verify($_detail, $_module = null)
	{
		$detail = self::row($_detail);
		if(isset($detail['verify']) && $detail['verify'])
		{
			return true;
		}


		if(in_array($_module, ['lock', 'dns']) && a($detail, 'verify_tech'))
		{
			return true;
		}

		return false;
	}
}
?>