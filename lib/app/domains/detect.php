<?php
namespace lib\app\domains;


class detect
{

	private static $detect = [];

	public static function whois($_domain, $_result = null)
	{
		if($_result)
		{
			$meta = [];
			if(isset($_result['answer']) && strpos($_result['answer'], 'http://whois.nic.ir/') !== false)
			{
				$meta['registrar'] = 'irnic';
			}

			if(isset($_result['registrar_info']['registrar']))
			{
				$meta['registrar'] = substr($_result['registrar_info']['registrar'], 0, 100);
			}

			if(isset($_result['important_dates']['last-updated']))
			{
				if(strtotime($_result['important_dates']['last-updated']) !== false)
				{
					$meta['dateupdate'] = date("Y-m-d H:i:s", strtotime($_result['important_dates']['last-updated']));
				}
			}

			if(isset($_result['important_dates']['creation-date']))
			{
				if(strtotime($_result['important_dates']['creation-date']) !== false)
				{
					$meta['dateregister'] = date("Y-m-d H:i:s", strtotime($_result['important_dates']['creation-date']));
				}
			}

			if(isset($_result['important_dates']['expire-date']))
			{
				if(strtotime($_result['important_dates']['expire-date']) !== false)
				{
					$meta['dateexpire'] = date("Y-m-d H:i:s", strtotime($_result['important_dates']['expire-date']));
				}
			}

			if(isset($_result['name_servers']['ns1']))
			{
				$meta['ns1'] = substr($_result['name_servers']['ns1'], 0, 100);
			}

			if(isset($_result['name_servers']['ns2']))
			{
				$meta['ns2'] = substr($_result['name_servers']['ns2'], 0, 100);
			}

			if(isset($_result['name_servers']['ns3']))
			{
				$meta['ns3'] = substr($_result['name_servers']['ns3'], 0, 100);
			}

			if(isset($_result['name_servers']['ns4']))
			{
				$meta['ns4'] = substr($_result['name_servers']['ns4'], 0, 100);
			}

			if(isset($_result['available']))
			{
				$meta['available'] = $_result['available'];
			}

			self::set($_domain, 'whois', $meta);

		}
		else
		{
			self::set($_domain, 'whois');
		}
	}


	public static function domain_info($_domain, $_info)
	{
		$domain_info = [];
		if(isset($_info[$_domain]))
		{
			$domain_info = $_info[$_domain];
		}

		$meta = [];

		$meta['holder']       = isset($domain_info['holder'])	? $domain_info['holder'] 	: null;
		$meta['admin']        = isset($domain_info['admin'])	? $domain_info['admin'] 	: null;
		$meta['tech']         = isset($domain_info['tech'])	 	? $domain_info['tech'] 		: null;
		$meta['bill']         = isset($domain_info['bill'])	 	? $domain_info['bill'] 		: null;
		$meta['nicstatus']    = isset($domain_info['status'])	? json_encode($domain_info['status'], JSON_UNESCAPED_UNICODE) 	: null;
		$meta['reseller']     = isset($domain_info['reseller'])	? $domain_info['reseller'] 	: null;
		$meta['roid']         = isset($domain_info['roid'])	 	? $domain_info['roid'] 		: null;
		$meta['dateregister'] = isset($domain_info['crDate'])	? date("Y-m-d H:i:s", strtotime($domain_info['crDate']))  	: null;
		$meta['dateexpire']   = isset($domain_info['exDate'])	? date("Y-m-d H:i:s", strtotime($domain_info['exDate'])) 	: null;
		$meta['ns1']          = isset($domain_info['ns'][0])	? $domain_info['ns'][0] 	: null;
		$meta['ns2']          = isset($domain_info['ns'][1])	? $domain_info['ns'][1] 	: null;
		$meta['ns3']          = isset($domain_info['ns'][2])	? $domain_info['ns'][2] 	: null;
		$meta['ns4']          = isset($domain_info['ns'][3])	? $domain_info['ns'][3] 	: null;

		self::set($_domain, 'info', $meta);
	}


	public static function dns($_domain)
	{
		self::set($_domain, 'dns');
	}


	public static function domain($_type, $_domain, $_meta = [])
	{
		$meta = [];

		if(isset($_meta['available']))
		{
			$meta['available'] = $_meta['available'];
		}

		self::set($_domain, $_type, $meta);
	}


	public static function domain_check_multi($_domains)
	{
		if(!is_array($_domains))
		{
			return;
		}

		foreach ($_domains as $key => $value)
		{
			if(isset($value['name']) && isset($value['tld']))
			{
				$meta = [];

				$domain = $value['name']. '.'. $value['tld'];

				if(isset($value['available']))
				{
					$meta['available'] = $value['available'];
				}

				self::set($domain, 'check_multi', $meta);
			}
		}
	}



	public static function set($_domain, $_type, $_meta = [])
	{

		if(!$_domain)
		{
			return;
		}

		$detail = self::analyze_domain($_domain);
		if(!$detail)
		{
			return false;
		}

		if(isset(self::$detect[$_domain]['id']))
		{
			$domain_id = self::$detect[$_domain]['id'];
		}
		else
		{
			$domain_id              = self::id($detail, $_meta);
			$detail['id']           = $domain_id;
			self::$detect[$_domain] = $detail;
		}


		$insert_domainactivity =
		[
			'domain_id'    => $domain_id,
			'user_id'      => \dash\user::id(),
			'datecreated'  => date("Y-m-d H:i:s"),
			'type'         => $_type,
			'ip'           => \dash\server::ip(true),
			'result'       => null,
			'available'    => (isset($_meta['available']) && $_meta['available']) ? 1 : null,
			'holder'       => isset($_meta['holder']) 		? $_meta['holder'] 			: null,
			'admin'        => isset($_meta['admin']) 		? $_meta['admin'] 			: null,
			'tech'         => isset($_meta['tech']) 		? $_meta['tech'] 			: null,
			'bill'         => isset($_meta['bill']) 		? $_meta['bill'] 			: null,
			'nicstatus'    => isset($_meta['nicstatus']) 	? $_meta['nicstatus'] 		: null,
			'reseller'     => isset($_meta['reseller']) 	? $_meta['reseller'] 		: null,
			'roid'         => isset($_meta['roid']) 		? $_meta['roid'] 			: null,
			'dateregister' => isset($_meta['dateregister']) ? $_meta['dateregister'] 	: null,
			'dateexpire'   => isset($_meta['dateexpire']) 	? $_meta['dateexpire'] 		: null,
			'ns1'          => isset($_meta['ns1']) 			? $_meta['ns1'] 			: null,
			'ns2'          => isset($_meta['ns2']) 			? $_meta['ns2'] 			: null,
			'ns3'          => isset($_meta['ns3']) 			? $_meta['ns3'] 			: null,
			'ns4'          => isset($_meta['ns4']) 			? $_meta['ns4'] 			: null,
			// 'runtime'     => \dash\runtime::json(),
		];

		\lib\db\domains\insert::new_record_activity($insert_domainactivity);
	}


	private static function analyze_domain($_domain)
	{
		$domain = \dash\validate::string_200($_domain, false);
		if(!$domain)
		{
			return false;
		}

		$_domain = mb_strtolower($_domain);
		$_domain = urldecode($_domain);

		$subdomain = null;
		$root      = null;
		$tld       = null;

		$domain = explode('.', $domain);
		// remove empty character for example reza.
		$domain = array_filter($domain);

		if(count($domain) >= 4)
		{
			$subdomain = $domain[0];

			array_shift($domain);
			reset($domain);

			$root      = $domain[0];

			array_shift($domain);
			reset($domain);

			$tld       = implode('.', $domain);
		}
		elseif(count($domain) === 3)
		{
			$subdomain = $domain[0];
			$root      = $domain[1];
			$tld       = $domain[2];
		}
		elseif(count($domain) === 2)
		{
			$root      = $domain[0];
			$tld       = $domain[1];
		}
		else
		{
			return false;
		}

		// 'id.ir','gov.ir','co.ir','net.ir','org.ir','sch.ir','ac.ir',
		if($tld === 'ir' && in_array($root, ['id', 'gov', 'co', 'net', 'org', 'sch', 'ac']))
		{
			$tld       = $root. '.'. $tld;
			$root      = $subdomain;
			$subdomain = null;
		}

		$result =
		[
			'datecreated' => date("Y-m-d H:i:s"),
			'subdomain' => $subdomain,
			'root'      => $root,
			'tld'       => $tld,
			'domain'    => $_domain,
			'domainlen' => mb_strlen($root),
		];

		return $result;

	}


	private static function id($_detail, $_meta)
	{

		$allow_field = ['domain','root','tld','domainlen','registrar','datecreated','dateregister','dateexpire','dateupdate','ns1','ns2','ns3','ns4', 'holder','admin','tech','bill','nicstatus','reseller','roid'];

		$check_exists = \lib\db\domains\get::check_exists($_detail['domain']);

		if(isset($check_exists['id']))
		{
			$update = [];
			$new_detail = $_meta;

			if(!is_array($new_detail))
			{
				$new_detail = [];
			}
			$new_detail = array_map('mb_strtolower', $new_detail);

			foreach ($allow_field as $field)
			{
				if(array_key_exists($field, $check_exists) && array_key_exists($field, $new_detail) && !\dash\validate::is_equal($new_detail[$field], $check_exists[$field]))
				{
					$update[$field] = $new_detail[$field];
				}
			}

			if(!empty($update))
			{
				$update['datemodified'] = date("Y-m-d H:i:s");
				\lib\db\domains\update::update($update, $check_exists['id']);
			}

			return $check_exists['id'];
		}
		else
		{
			if(!is_array($_detail))
			{
				$_detail = [];
			}
			if(!is_array($_meta))
			{
				$_meta = [];
			}

			$args = array_merge($_detail, $_meta);
			$args = array_map('mb_strtolower', $args);

			$insert = [];

			foreach ($args as $key => $value)
			{
				// allow field
				if(in_array($key, $allow_field))
				{
					$insert[$key] = $value;
				}
			}

			$insert_id = \lib\db\domains\insert::new_record($insert);
			return $insert_id;
		}
	}
}
?>