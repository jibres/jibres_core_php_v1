<?php
namespace lib\app\nic_domain;


class ready
{
	public static function row($_data)
	{
		if(isset($_data['lastfetch']) && $_data['lastfetch'])
		{
			// fetch every 1 hour
			if(time() - strtotime($_data['lastfetch']) > (60*60))
			{
				\lib\app\nic_domain\get::update_fetch($_domain, $_data);
				$_data = \lib\db\nic_domain\get::domain_user($_domain, \dash\user::id());
			}
		}
		else
		{
			\lib\app\nic_domain\get::update_fetch($_domain, $_data);
			$_data = \lib\db\nic_domain\get::domain_user($_domain, \dash\user::id());
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

						// ok
						// serverHold
						// irnicReserved
						// serverRenewProhibited
						// serverDeleteProhibited
						// irnicRegistrationPendingDomainCheck
						// irnicRegistrationRejected

						if(in_array('irnicRegistrationRejected', $nicstatus))
						{
							$status_html =  '<div class="ibtn wide"><span>'. T_("Reject").'</span><i class="sf-times fc-red"></i></div>';
						}

						if(in_array('irnicRegistrationPendingDomainCheck', $nicstatus))
						{
							$status_html =  '<div class="ibtn wide"><span>'. T_("Pending").'</span><i class="sf-refresh fc-blue"></i></div>';
						}

						if(in_array('ok', $nicstatus))
						{
							$status_html =  '<div class="ibtn wide"><span>'. T_("Enable").'</span><i class="sf-check fc-green"></i></div>';
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