<?php
namespace lib\app\domains;


class owner
{
	/**
	 * Check domain owner with whois and email
	 */
	public static function check()
	{
		$not_checked = \lib\db\nic_domain\get::not_checked_owner();
		if($not_checked && is_array($not_checked))
		{
			foreach ($not_checked as $key => $value)
			{
				self::fetch_domain_owner($value['name']);
			}
		}

		$need_check_owner_again = \lib\db\nic_domain\get::need_check_owner_again();

		if($need_check_owner_again && is_array($need_check_owner_again))
		{
			foreach ($need_check_owner_again as $key => $value)
			{
				self::fetch_domain_owner($value['name']);
			}
		}
	}


	public static function fetch_domain_owner($_domain)
	{
		\lib\db\nic_domain\update::update_by_domain(['ownercheckdate' => date("Y-m-d H:i:s")], $_domain);

		$whois_detail = \lib\app\whois\who::is($_domain);

		self::update_owner_detail($whois_detail, $_domain);
	}


	public static function update_owner_detail($_whois_detail, $_domain)
	{

		if(!\lib\db\nic_domain\get::for_anybody($_domain))
		{
			return;
		}

		$email  = null;
		$mobile = null;

		if(isset($_whois_detail['registrar']) && is_array($_whois_detail['registrar']))
		{
			foreach ($_whois_detail['registrar'] as $key => $value)
			{
				if(isset($value['e-mail']) && $value['e-mail'])
				{
					$email_temp = \dash\validate::email($value['e-mail'], false);
					if(!$email)
					{
						$email = $email_temp;
					}
				}

				if(isset($value['phone']) && $value['phone'])
				{
					$mobile_temp = \dash\validate::mobile($value['phone'], false);
					if(!$mobile)
					{
						$mobile = $mobile_temp;
					}
				}

				if(isset($value['fax-no']) && $value['fax-no'])
				{
					$mobile_temp = \dash\validate::mobile($value['fax-no'], false);
					if(!$mobile)
					{
						$mobile = $mobile_temp;
					}
				}
			}
		}

		if($mobile || $email)
		{
			$update =
			[
				'email'          => $email,
				'mobile'         => $mobile,
				'ownercheckdate' => date("Y-m-d H:i:s"),
			];

			\lib\db\nic_domain\update::update_by_domain($update, $_domain);
		}
	}
}
?>