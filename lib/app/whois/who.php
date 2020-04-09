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

		$result = [];

		$_domain = urldecode($_domain);

		// Creating default configured client
		$whois = \lib\nic\Iodev\Whois\Whois::create();

		$result['domain'] = $_domain;

		// Checking availability
		if ($whois->isDomainAvailable($_domain))
		{
			$result['available'] = true;
		}
		else
		{
			$result['available'] = false;

		}

		$response = $whois->lookupDomain($_domain);
		$result['answer'] = $response->getText();

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

				$group = 'Registrar Data';
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





	public static function is_old($_domain)
	{
		if(!\dash\validate::domain($_domain))
		{
			return false;
		}

		$result = null;

		$domain = new \lib\nic\phpwhois\whois($_domain);
		if(\dash\engine\process::status())
		{
			$whois_answer                  = $domain->info();
			$result                        = [];
			$result['answer']              = $whois_answer;
			$result['php_whois_available'] = $domain->isAvailable();

		}

		$check_domain = \lib\app\nic_domain\check::check($_domain);
		if(isset($check_domain['available']) && $check_domain['available'])
		{
			$result['available'] = true;
		}
		else
		{
			$result['available'] = false;
		}


		return $result;

	}


}
?>