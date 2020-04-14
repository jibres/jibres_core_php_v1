<?php
namespace lib\app\whois;



class who
{

	public static function is($_domain)
	{
		$_domain = \dash\validate::domain($_domain, false);

		if(!$_domain)
		{
			return false;
		}

		$result              = [];
		$answer              = null;



		$result['domain']    = $_domain;
		$result['available'] = false;

		try
		{

			$phpwhois = new \lib\nic\phpwhois\whois($_domain);

			$answer                  = $phpwhois->info();

			if($phpwhois->isAvailable())
			{
				$result['available'] = true;
			}

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

		return $result;

	}


	public static function is_by_iodev($_domain)
	{
		if(!\dash\validate::domain($_domain, false))
		{
			return false;
		}

		$result = [];
		$answer = null;

		$_domain = urldecode($_domain);

		$result['domain']    = $_domain;
		$result['available'] = false;

		try
		{
			// Creating default configured client
			$whois = \lib\nic\Iodev\Whois\Whois::create();

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


		foreach ($whois_lines as  $line)
		{
			if(substr($line, 0, 1) === '%')
			{
				continue;
			}

			if($line === '')
			{
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

			$key = mb_strtolower($key);

			if(in_array($key, ['holder-c','admin-c','tech-c','bill-c', 'nic-hdl', 'registrar',]))
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

			if(in_array($key, ['person', 'e-mail', 'address', 'phone', 'org']))
			{
				$group = 'registrar';
			}


			if($group !== 'other')
			{
				if($group && !isset($pre[$group]))
				{
					$pre[$group] = [];
				}
				if($key || $value)
				{
					$pre[$group][$key] = $value;
				}
			}

		}

		$result = array_merge($pre, $result);

	}


}
?>