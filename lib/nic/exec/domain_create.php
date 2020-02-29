<?php
namespace lib\nic\exec;


class domain_create
{


	public static function create($_args)
	{
		$create = self::analyze_domain_create($_args);

		if(!$create || !is_array($create))
		{
			return false;
		}

		if(!isset($create['name']))
		{
			return false;
		}

		$result                 = [];
		$result['name']         = $create['name'];
		$result['dateregister'] = isset($create['crDate']) ? date("Y-m-d H:i:s", strtotime($create['crDate'])) : null;
		$result['dateexpire']  = isset($create['exDate']) ? date("Y-m-d H:i:s", strtotime($create['exDate'])) : null;

		return $result;
	}




	private static function analyze_domain_create($_args)
	{

		$object_result = self::get_response_create($_args);

		if(!$object_result)
		{
			return false;
		}

		$result = [];
		if(!isset($object_result->response->resData))
		{
			return false;
		}

		if(!$object_result->response->resData->xpath('domain:creData'))
		{
			return false;
		}

		foreach ($object_result->response->resData->xpath('domain:creData') as  $domaincreData)
		{
			$temp  = [];

			foreach ($domaincreData->xpath('domain:name') as $domainname)
			{
				$myKey = $domainname->__toString();
				$temp['name']   = $myKey;
			}


			foreach ($domaincreData->xpath('domain:crDate') as $domaincrDate)
			{
				$temp['crDate']   = $domaincrDate->__toString();
			}

			foreach ($domaincreData->xpath('domain:exDate') as $domainexDate)
			{
				$temp['exDate']   = $domainexDate->__toString();
			}

			$result = $temp;
		}

		return $result;
	}


	private static function get_response_create($_args)
	{
		$addr = root. 'lib/nic/exec/samples/domain_create.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_args['domain'], $xml);
		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);

		$have_any_dns = false;
		if(isset($_args['ns3']) && $_args['ns3'])
		{
			$have_any_dns = true;
			$temp_xml = '<domain:hostAttr><domain:hostName>NS2.JIBRES.TLD</domain:hostName></domain:hostAttr><domain:hostAttr><domain:hostName>NS3.JIBRES.TLD</domain:hostName></domain:hostAttr>';
			$xml = str_replace('<domain:hostAttr><domain:hostName>NS2.JIBRES.TLD</domain:hostName></domain:hostAttr>', $temp_xml, $xml);
		}

		if(isset($_args['ns4']) && $_args['ns4'])
		{
			$have_any_dns = true;
			if(isset($_args['ns3']) && $_args['ns3'])
			{
				$temp_xml = '<domain:hostAttr><domain:hostName>NS3.JIBRES.TLD</domain:hostName></domain:hostAttr><domain:hostAttr><domain:hostName>NS4.JIBRES.TLD</domain:hostName></domain:hostAttr>';
				$xml = str_replace('<domain:hostAttr><domain:hostName>NS3.JIBRES.TLD</domain:hostName></domain:hostAttr>', $temp_xml, $xml);
			}
			else
			{
				$temp_xml = '<domain:hostAttr><domain:hostName>NS2.JIBRES.TLD</domain:hostName></domain:hostAttr><domain:hostAttr><domain:hostName>NS4.JIBRES.TLD</domain:hostName></domain:hostAttr>';
				$xml = str_replace('<domain:hostAttr><domain:hostName>NS2.JIBRES.TLD</domain:hostName></domain:hostAttr>', $temp_xml, $xml);
			}
		}

		$sample_ip_xml = '<domain:hostAddr ip="v4">JIBRES-SAMPLE-IP</domain:hostAddr>';

		if(isset($_args['ip1']) && $_args['ip1'])
		{
			$have_any_dns = true;

			$temp_sample_ip_xml = str_replace('JIBRES-SAMPLE-IP', $_args['ip1'], $sample_ip_xml);
			$xml = str_replace('<domain:hostName>NS1.JIBRES.TLD</domain:hostName>', '<domain:hostName>NS1.JIBRES.TLD</domain:hostName>'. $temp_sample_ip_xml, $xml);
		}

		if(isset($_args['ip2']) && $_args['ip2'])
		{
			$have_any_dns = true;

			$temp_sample_ip_xml = str_replace('JIBRES-SAMPLE-IP', $_args['ip2'], $sample_ip_xml);
			$xml = str_replace('<domain:hostName>NS2.JIBRES.TLD</domain:hostName>', '<domain:hostName>NS2.JIBRES.TLD</domain:hostName>'. $temp_sample_ip_xml, $xml);
		}

		if(isset($_args['ip3']) && $_args['ip3'])
		{
			$have_any_dns = true;

			$temp_sample_ip_xml = str_replace('JIBRES-SAMPLE-IP', $_args['ip3'], $sample_ip_xml);
			$xml = str_replace('<domain:hostName>NS3.JIBRES.TLD</domain:hostName>', '<domain:hostName>NS3.JIBRES.TLD</domain:hostName>'. $temp_sample_ip_xml, $xml);
		}

		if(isset($_args['ip4']) && $_args['ip4'])
		{
			$have_any_dns = true;

			$temp_sample_ip_xml = str_replace('JIBRES-SAMPLE-IP', $_args['ip4'], $sample_ip_xml);
			$xml = str_replace('<domain:hostName>NS4.JIBRES.TLD</domain:hostName>', '<domain:hostName>NS4.JIBRES.TLD</domain:hostName>'. $temp_sample_ip_xml, $xml);
		}

		if(isset($_args['ns1']) && $_args['ns1'])
		{
			$have_any_dns = true;

			$xml = str_replace('NS1.JIBRES.TLD', $_args['ns1'], $xml);
		}
		else
		{
			$xml = str_replace('<domain:hostAttr><domain:hostName>NS1.JIBRES.TLD</domain:hostName></domain:hostAttr>', '', $xml);
		}

		if(isset($_args['ns2']) && $_args['ns2'])
		{
			$have_any_dns = true;

			$xml = str_replace('NS2.JIBRES.TLD', $_args['ns2'], $xml);
		}
		else
		{
			$xml = str_replace('<domain:hostAttr><domain:hostName>NS2.JIBRES.TLD</domain:hostName></domain:hostAttr>', '', $xml);
		}

		if(!$have_any_dns)
		{
			$xml = str_replace('<domain:ns></domain:ns>', '', $xml);
		}

		if(isset($_args['ns3']) && $_args['ns3'])
		{
			$xml = str_replace('NS3.JIBRES.TLD', $_args['ns3'], $xml);
		}

		if(isset($_args['ns4']) && $_args['ns4'])
		{
			$xml = str_replace('NS4.JIBRES.TLD', $_args['ns4'], $xml);
		}

		$xml = str_replace('PERIOD', $_args['period'], $xml);

		$xml = str_replace('<domain:contact type="holder">JIBRES-NIC-ACCOUNT</domain:contact>', '<domain:contact type="holder">'. $_args['nic_id']. '</domain:contact>', $xml);

		if(isset($_args['irnic_admin']) && $_args['irnic_admin'])
		{
			$xml = str_replace('<domain:contact type="admin">JIBRES-NIC-ACCOUNT</domain:contact>', '<domain:contact type="admin">'. $_args['irnic_admin']. '</domain:contact>', $xml);
		}
		else
		{
			$xml = str_replace('<domain:contact type="admin">JIBRES-NIC-ACCOUNT</domain:contact>', '<domain:contact type="admin">'. $_args['nic_id']. '</domain:contact>', $xml);
		}

		if(isset($_args['irnic_tech']) && $_args['irnic_tech'])
		{
			$xml = str_replace('<domain:contact type="tech">JIBRES-NIC-ACCOUNT</domain:contact>', '<domain:contact type="tech">'. $_args['irnic_tech']. '</domain:contact>', $xml);
		}
		else
		{
			$xml = str_replace('<domain:contact type="tech">JIBRES-NIC-ACCOUNT</domain:contact>', '<domain:contact type="tech">'. $_args['nic_id']. '</domain:contact>', $xml);
		}


		if(isset($_args['irnic_bill']) && $_args['irnic_bill'])
		{
			$xml = str_replace('<domain:contact type="bill">JIBRES-NIC-ACCOUNT</domain:contact>', '<domain:contact type="bill">'. $_args['irnic_bill']. '</domain:contact>', $xml);
		}
		else
		{
			$xml = str_replace('<domain:contact type="bill">JIBRES-NIC-ACCOUNT</domain:contact>', '<domain:contact type="bill">'. $_args['nic_id']. '</domain:contact>', $xml);
		}

		// $xml = str_replace('JIBRES-NIC-ACCOUNT', $_args['nic_id'], $xml);

		$insert_log =
		[
			'type'          => 'domain_create',
			'user_id'       => \dash\user::id(),
			'send'          => null,
			'datesend'      => date("Y-m-d H:i:s"),
			'request_count' => 1,
		];

		$log_id = \lib\db\nic_log\insert::new_record($insert_log);


		$tracking_number = \lib\nic\exec\run::make_tracking_number($log_id, get_class());

		$xml = str_replace('JIBRES-TRACKING-NUMBER', $tracking_number, $xml);

		$update_befor_send =
		[
			'send'      => addslashes($xml),
			'client_id' => $tracking_number,
		];

		\lib\db\nic_log\update::update($update_befor_send, $log_id);

		$response = \lib\nic\exec\run::send($xml);

		$update_after_send = [];

		$update_after_send['dateresponse'] = date("Y-m-d H:i:s");

		if(isset($response))
		{
			$update_after_send['response'] = addslashes($response);
		}


		if(!$response)
		{
			\dash\notif::error(T_("IRNIC server is not available at this time"));
			return false;
		}


		try
		{
			$object = new \SimpleXMLElement($response);
		}
		catch (\Exception $e)
		{
			\dash\notif::error(T_("Can not connect to domain server"));
			\lib\db\nic_log\update::update($update_after_send, $log_id);
			return false;
		}

		$update_after_send['result_code'] = \lib\nic\exec\run::result_code($object);
		$update_after_send['server_id'] = \lib\nic\exec\run::server_id($object);


		\lib\db\nic_log\update::update($update_after_send, $log_id);

		return $object;

	}




}
?>