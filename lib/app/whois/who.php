<?php
namespace lib\app\whois;



class who
{

	public static function is($_domain)
	{
		if(!\dash\validate::domain($_domain, false))
		{
			return false;
		}

		$result              = [];
		$answer              = null;
		$_domain             = urldecode($_domain);
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

			\dash\notif::error(T_("Can not connect to whois service not! Please try again later"));
			return false;
		}

		$result['answer'] = $answer;

		if(\dash\validate::ir_domain($_domain, false))
		{
			self::analyze_response_ir($result);
		}
		else
		{
			self::analyze_response($result);
		}


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
				\dash\notif::error(T_("Can not connect to whois service not! Please try again later"));
			}
			return false;
		}

		$result['answer'] = $answer;

		if(\dash\validate::ir_domain($_domain, false))
		{
			self::analyze_response_ir($result);
		}
		else
		{
			self::analyze_response($result);
		}

		return $result;

	}


	private static function analyze_response_ir(&$result)
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
		$pre['desc'] = [];

		foreach ($whois_lines as  $line)
		{
			if(substr($line, 0, 1) === '%')
			{
				$pre['desc'][] = $line;
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

			if(in_array($key, ['holder-c','admin-c','tech-c','bill-c', 'nic-hdl']))
			{
				if($key === 'holder-c')
				{
					$key = "Holder";
				}

				if($key === 'admin-c')
				{
					$key = "Admin holder";
				}

				if($key === 'tech-c')
				{
					$key = "Technical holder";
				}

				if($key === 'bill-c')
				{
					$key = "Billing holder";
				}

				if($key === 'nic-hdl')
				{
					$key = "IRNIC holder";
				}

				$group = 'Registrar Info';
			}

			if(in_array($key, ['domain','ascii']))
			{
				$group = 'Domain name';
			}

			if(in_array($key, ['remarks', 'source']))
			{
				$group = 'Other';
			}

			if(in_array($key, ['nserver']))
			{
				$group = 'Name Servers';
			}

			if(in_array($key, ['last-updated', 'expire-date']))
			{
				if($key === 'last-updated')
				{
					$key = "Last updated";
				}

				if($key === 'expire-date')
				{
					$key = "Expire date";
				}

				$group = 'Important Dates';
			}

			if(in_array($key, ['person', 'e-mail', 'address', 'phone', 'org']))
			{
				if($key === 'person')
				{
					$key = "Admin Name";
				}

				if($key === 'e-mail')
				{
					$key = "Email";
				}

				if($key === 'address')
				{
					$key = "Address";
				}

				$group = 'Registrar';
			}

			if($group && !isset($pre[$group]))
			{
				$pre[$group] = [];
			}

			if($key || $value)
			{
				$pre[$group][] = ['key' => $key, 'title' => T_(ucfirst($key)), 'value' => $value];
			}
		}

		$pre['desc'] = implode("\n", $pre['desc']);

		$result['pretty'] = $pre;

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
		$pre['desc'] = [];

		foreach ($whois_lines as  $line)
		{
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

			if(in_array($key, ['Updated Date', 'Creation Date', 'Registrar Registration Expiration Date']))
			{
				$group = "Important Dates";
			}

			if(in_array($key, ['Registrar',]))
			{
				$group = "Registrar";
			}

			if(in_array($key, ['Name Server']))
			{
				$group = "Name Servers";
			}

			if($group && !isset($pre[$group]))
			{
				$pre[$group] = [];
			}

			if($key || $value)
			{
				$pre[$group][] = ['key' => $key, 'title' => T_(ucfirst($key)), 'value' => $value];
			}
		}

		$result['pretty'] = $pre;
	}
}
?>