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

		$result['answer'] = 'Domain name: jibres.com
Registry Domain ID: 1880989581_DOMAIN_COM-VRSN
Registrar WHOIS Server: whois.namecheap.com
Registrar URL: http://www.namecheap.com
Updated Date: 2019-02-08T19:53:14.39Z
Creation Date: 2014-10-18T12:04:45.00Z
Registrar Registration Expiration Date: 2022-10-18T12:04:45.00Z
Registrar: NAMECHEAP INC
Registrar IANA ID: 1068
Registrar Abuse Contact Email: abuse@namecheap.com
Registrar Abuse Contact Phone: +1.6613102107
Reseller: NAMECHEAP INC
Domain Status: clientTransferProhibited https://icann.org/epp#clientTransferProhibited
Registry Registrant ID:
Registrant Name: WhoisGuard Protected
Registrant Organization: WhoisGuard, Inc.
Registrant Street: P.O. Box 0823-03411
Registrant City: Panama
Registrant State/Province: Panama
Registrant Postal Code:
Registrant Country: PA
Registrant Phone: +507.8365503
Registrant Phone Ext:
Registrant Fax: +51.17057182
Registrant Fax Ext:
Registrant Email: d9ad7f4f0a5a4d31a21c4b3f24b8bafc.protect@whoisguard.com
Registry Admin ID:
Admin Name: WhoisGuard Protected
Admin Organization: WhoisGuard, Inc.
Admin Street: P.O. Box 0823-03411
Admin City: Panama
Admin State/Province: Panama
Admin Postal Code:
Admin Country: PA
Admin Phone: +507.8365503
Admin Phone Ext:
Admin Fax: +51.17057182
Admin Fax Ext:
Admin Email: d9ad7f4f0a5a4d31a21c4b3f24b8bafc.protect@whoisguard.com
Registry Tech ID:
Tech Name: WhoisGuard Protected
Tech Organization: WhoisGuard, Inc.
Tech Street: P.O. Box 0823-03411
Tech City: Panama
Tech State/Province: Panama
Tech Postal Code:
Tech Country: PA
Tech Phone: +507.8365503
Tech Phone Ext:
Tech Fax: +51.17057182
Tech Fax Ext:
Tech Email: d9ad7f4f0a5a4d31a21c4b3f24b8bafc.protect@whoisguard.com
Name Server: anna.ns.cloudflare.com
Name Server: damon.ns.cloudflare.com
DNSSEC: unsigned
URL of the ICANN WHOIS Data Problem Reporting System: http://wdprs.internic.net/
>>> Last update of WHOIS database: 2020-04-09T00:13:02.23Z <<<

For more information on Whois status codes, please visit https://icann.org/epp';
		$_domain = urldecode($_domain);

		// // Creating default configured client
		// $whois = \lib\nic\Iodev\Whois\Whois::create();

		$result['domain'] = $_domain;

		// // Checking availability
		// if ($whois->isDomainAvailable($_domain))
		// {
		// 	$result['available'] = true;
		// }
		// else
		// {
		// 	$result['available'] = false;

		// }

		// $response = $whois->lookupDomain($_domain);
		// $result['answer'] = $response->getText();

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