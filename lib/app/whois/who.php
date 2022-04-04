<?php
namespace lib\app\whois;



class who
{

	public static function is($_domain)
	{
		$_domain = \dash\validate::domain($_domain);

		if(!$_domain)
		{
			return false;
		}

		$result              = [];
		$answer              = null;



		$result['domain']    = $_domain;
		$result['available'] = false;

		self::check_limit($_domain);


		try
		{

			// $phpwhois = new \lib\api\nic\phpwhois\whois($_domain);
			$phpwhois = \lib\api\whois\api::get($_domain);

			$answer                  = a($phpwhois, 'answer');
			$result['available'] = a($phpwhois, 'available');

		}
		catch (\Exception $e)
		{

			\dash\notif::error(T_("Can not connect to whois service now! Please try again later"));
			\lib\app\domains\detect::whois($_domain);
			return false;
		}

		$result['answer'] = $answer;

		self::analyze_response($result);

		\lib\app\domains\detect::whois($_domain, $result);

		if(\dash\validate::ir_domain($_domain, false))
		{
			self::save_nic_contact_detail($result);
		}

		if($_domain && $result)
		{
			\lib\app\domains\owner::update_owner_detail($result, $_domain);
		}

		return $result;

	}


	private static function check_limit($_domain)
	{
		$check_log           = [];
		$check_log['caller'] = 'send_whois_request';

		$this_hour           = date("Y-m-d H:i:s", (time() - (60*60)));

		if(\dash\user::id())
		{
			$check_log['from']   = \dash\user::id();

			$get_count_log = \dash\db\logs::count_where_date($check_log, $this_hour);

			if($get_count_log > 50)
			{
				\dash\waf\ip::isolateIP(2, 'send_whois_request per user');
			}
		}
		else
		{
			$check_log['ip_id']   = \dash\utility\ip::id();

			$get_count_log = \dash\db\logs::count_where_date($check_log, $this_hour);

			if($get_count_log > 50)
			{
				\dash\waf\ip::isolateIP(2, 'send_whois_request per ip');
			}
		}

		$insert_log =
		[
			'data'   => $_domain
		];

		\dash\log::set('send_whois_request', $insert_log);

	}


	public static function is_by_iodev($_domain)
	{
		if(!\dash\validate::domain($_domain, false))
		{
			return false;
		}

		$result = [];
		$answer = null;

		$_domain = \dash\str::urldecode($_domain);

		$result['domain']    = $_domain;
		$result['available'] = false;

		try
		{
			// Creating default configured client
			$whois = \lib\api\nic\Iodev\Whois\Whois::create();

			// Checking availability
			if ($whois->isDomainAvailable($_domain))
			{
				$result['available'] = true;
			}

			$response = $whois->lookupDomain($_domain);

			$answer =  $response->getText();
		}
		catch (\Exception $e)
		{
			$mesage = $e->getMessage();

			if(substr($mesage, 0, 29) === 'No servers matched for domain')
			{
				\dash\notif::error(T_("No servers matched for domain :val", ['val' => $_domain]), 'domain');
			}
			else
			{
				\dash\notif::error(T_("Can not connect to whois service now! Please try again later"));
			}
			return false;
		}

		$result['answer'] = $answer;

		self::analyze_response($result);

		return $result;

	}


	private static function analyze_response(&$result)
	{
		if(isset($result['answer']) && $result['answer'] && is_string($result['answer']))
		{
			$whois = $result['answer'];
		}
		else
		{
			return false;
		}

		$whois_lines = explode("\n", $whois);

		$pre = [];
		$group_index = 0;

		foreach ($whois_lines as  $line)
		{
			if(substr($line, 0, 1) === '%')
			{
				continue;
			}

			if($line === '')
			{
				$group_index++;
				continue;
			}

			$detect = explode(':', $line, 2);
			$key    = null;
			$value  = null;
			$group  = 'other';

			if(isset($detect[0]))
			{
				$key = trim($detect[0]);
			}

			if(isset($detect[1]))
			{
				$value = trim($detect[1]);
			}

			$key = \dash\str::mb_strtolower($key);

			if(in_array($key, ['holder-c','admin-c','tech-c','bill-c', 'registrar',]))
			{
				$group = 'registrar_info';
			}

			if(in_array($key, ['domain','ascii']))
			{
				$group = 'domain_name';
			}

			if(in_array($key, ['remarks', 'source']))
			{
				$group = 'other';
			}

			if(in_array($key, ['nserver', 'name server']))
			{
				$group = 'name_servers';
				if(!isset($pre[$group]['ns1']))
				{
					$pre[$group]['ns1'] = $value;
					continue;
				}

				if(!isset($pre[$group]['ns2']))
				{
					$pre[$group]['ns2'] = $value;
					continue;
				}

				if(!isset($pre[$group]['ns3']))
				{
					$pre[$group]['ns3'] = $value;
					continue;
				}

				if(!isset($pre[$group]['ns4']))
				{
					$pre[$group]['ns4'] = $value;
					continue;
				}
			}

			if(in_array($key, ['last-updated', 'expire-date', 'updated date', 'creation date', 'registrar registration expiration date']))
			{
				$group = 'important_dates';

				if($key === 'updated date' || $key === 'last-updated')
				{
					$key = 'last-updated';
				}

				if($key === 'creation date' || $key === 'registrar registration expiration date')
				{
					$key = str_replace(" ", '-', $key);
				}
			}

			if(in_array($key, ['person', 'e-mail', 'address', 'phone', 'org', 'nic-hdl', 'fax-no']))
			{
				$group = 'registrar';
			}


			if($group !== 'other')
			{
				// if($group && !isset($pre[$group]))
				// {
				// 	if($group === 'registrar')
				// 	{
				// 		$pre[$group_index][$group] = [];
				// 	}
				// 	else
				// 	{
				// 		$pre[$group] = [];
				// 	}
				// }

				if($key || $value)
				{
					if($group === 'registrar')
					{
						if(isset($pre[$group][$group_index][$key]))
						{
							$pre[$group][$group_index][$key] = [$pre[$group][$group_index][$key]];
							$pre[$group][$group_index][$key][] = $value;
						}
						else
						{
							$pre[$group][$group_index][$key] = $value;
						}



					}
					else
					{
						if(isset($pre[$group][$key]))
						{
							$pre[$group][$key] = [$pre[$group][$key]];
							$pre[$group][$key][] = $value;
						}
						else
						{
							$pre[$group][$key] = $value;
						}
					}
				}
			}

		}

		if(isset($pre['registrar']) && is_array($pre['registrar']))
		{
			$pre['registrar'] = array_values($pre['registrar']);
		}

		$result = array_merge($pre, $result);

	}



	private static function save_nic_contact_detail($_result)
	{
		$answer = isset($_result['answer']) ? $_result['answer'] : null;
		if(!$answer)
		{
			return;
		}

		$explode = explode('source:', $answer);


		$nic_contact = [];
		foreach ($explode as $value)
		{
			$check_value = self::remove_nl_space($value);

			if(substr($check_value, 0, 22) === 'IRNIC#Filterednic-hdl:')
			{
				$nic_contact[] = $value;
			}
		}

		if(empty($nic_contact))
		{
			return;
		}

		$nic_contact_detail = [];
		foreach ($nic_contact as $nic_detail)
		{
			$nic_detail_explode = explode("\n", $nic_detail);

			$temp = [];

			foreach ($nic_detail_explode as  $line)
			{
				$explode_value = explode(":", $line);
				$explode_value = array_map('trim', $explode_value);

				if(count($explode_value) === 2)
				{
					switch ($explode_value[0])
					{
						case 'nic-hdl':
							$temp['nic_id'] = $explode_value[1];
							break;

						case 'org':
							$temp['org'] = $explode_value[1];
							break;

						case 'e-mail':
							$temp['email'] = $explode_value[1];
							break;

						case 'address':
							$temp['address'] = $explode_value[1];
							break;


						case 'person':
							$temp['person'] = $explode_value[1];
							break;

						case 'phone':
							$mobile = \dash\validate::mobile($explode_value[1], false);
							if($mobile)
							{
								$temp['mobile'] = $mobile;
							}
							$temp['phone'] = $explode_value[1];
							break;

						case 'fax-no':
							$temp['fax'] = $explode_value[1];
							break;
					}
				}
			}

			$temp = \dash\safe::safe($temp);

			$nic_contact_detail[] = $temp;
		}


		foreach ($nic_contact_detail as $key => $value)
		{
			if(isset($value['nic_id']))
			{
				$get_detail = \lib\db\nic_contactdetail\get::by_nic_id($value['nic_id']);
				if(isset($get_detail['id']))
				{
					$value['datemodified'] = date("Y-m-d H:i:s");
					\lib\db\nic_contactdetail\update::update($value, $get_detail['id']);
				}
				else
				{
					$value['datecreated'] = date("Y-m-d H:i:s");
					\lib\db\nic_contactdetail\insert::new_record($value);
				}
			}
		}

	}


	private static function remove_nl_space($_string)
	{
		$_string = preg_replace("/[\n]/", " ", $_string);
		$_string = trim($_string);
		$_string = str_replace(' ', '', $_string);
		return $_string;

	}

}
?>