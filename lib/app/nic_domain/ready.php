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


						if(in_array(['serverHold', 'irnicReserved', 'serverRenewProhibited', 'serverDeleteProhibited', 'irnicRegistrationApproved'], $nicstatus))
						{
							$status_html =  '<div class="ibtn x30 wide"><span>'. T_("Domain reserved").'</span><i class="sf-info-circle fc-blue"></i></div>';
						}


						$other_status_html = '';

						if($other_status)
						{
							foreach ($other_status as $key => $value)
							{
								$other_status_html.= '<span class="badge light" title="'. $value. '">'. T_($value). '</span>';
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
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}


		if(isset($result['available']) && $result['available'] === '1')
		{
			$new_result = [];
			$new_result['name'] = $result['name'];
			$status_html =  '<a href="'.\dash\url::this(). '/buy/'. $result['name'].'"><div class="ibtn x30 wide"><span>'. T_("Register now").'</span><i class="sf-shop fc-green"></i></div></a>';
			$new_result['status_html'] = $status_html;

			$result = $new_result;
		}

		return $result;
	}
}
?>