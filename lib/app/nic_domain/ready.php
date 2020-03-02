<?php
namespace lib\app\nic_domain;


class ready
{
	public static function row($_data)
	{
		$domain = isset($_data['name']) ? $_data['name'] : null;
		if($domain)
		{
			if(isset($_data['lastfetch']) && $_data['lastfetch'])
			{
				// fetch every 1 hour
				if(time() - strtotime($_data['lastfetch']) > (60*60))
				{
					\lib\app\nic_domain\get::update_fetch($domain, $_data);
					$_data = \lib\db\nic_domain\get::domain_user($domain, \dash\user::id());
				}
			}
			else
			{
				\lib\app\nic_domain\get::update_fetch($domain, $_data);
				$_data = \lib\db\nic_domain\get::domain_user($domain, \dash\user::id());
			}
		}

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
					$status_html = '<div class="ibtn wide"><span>'.T_("Unknown").'</span><i class="sf-question"></i></div>';
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

						if(in_array('irnicRegistrationRejected', $nicstatus))
						{
							$status_html =  '<div class="ibtn wide"><span>'. T_("Reject").'</span><i class="sf-times fc-red"></i></div>';
						}

						if(in_array('irnicRegistrationPendingDomainCheck', $nicstatus))
						{
							$status_html =  '<div class="ibtn wide"><span>'. T_("Pending Check Document").'</span><i class="sf-refresh fc-blue"></i></div>';
						}

						if(in_array('ok', $nicstatus))
						{
							$status_html =  '<div class="ibtn wide"><span>'. T_("Enable").'</span><i class="sf-check fc-green"></i></div>';
						}


						if(in_array('irnicLocked', $nicstatus))
						{
							$status_html =  '<div class="ibtn wide"><span>'. T_("Locked").'</span><i class="sf-lock fc-red"></i></div>';
						}


						if(in_array('irnicExpired', $nicstatus))
						{
							$status_html =  '<div class="ibtn wide"><span>'. T_("Expired").'</span><i class="sf-times fc-yellow"></i></div>';
						}


						if(in_array('irnicRegistrationDocRequired', $nicstatus))
						{
							$status_html =  '<div class="ibtn wide"><span>'. T_("Document required").'</span><i class="sf-info-circle fc-yellow"></i></div>';
						}

					}

					$result['status_html'] = $status_html;

					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}
}
?>