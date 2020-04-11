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

		$object_result = self::send_xml($_args);

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


	private static function send_xml($_args)
	{
		$addr = root. 'lib/nic/exec/samples/domain_create.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_args['domain'], $xml);

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

		$response = \lib\nic\exec\run::send($xml, 'domain_create', 1, $_args['domain']);

		return $response;

	}
}
?>