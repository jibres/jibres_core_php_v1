<?php
namespace lib\nic\exec;


class domain_update
{


	public static function update($_args)
	{
		$update = self::analyze_domain_update($_args);

		return $update;
	}




	private static function analyze_domain_update($_args)
	{

		$object_result = self::get_response_update($_args);

		if(!$object_result)
		{
			return false;
		}

		if(\lib\nic\exec\run::result_code($object_result) == 1000)
		{
			return true;
		}
		else
		{
			return false;
		}

	}


	private static function get_response_update($_args)
	{
		$addr = root. 'lib/nic/exec/samples/domain_update.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

// <domain:add><domain:ns><domain:hostAttr><domain:hostName>ns2.example.net</domain:hostName><domain:hostAddr ip="v4">192.0.2.2</domain:hostAddr></domain:hostAttr></domain:ns></domain:add>
// <domain:rem><domain:ns><domain:hostAttr><domain:hostName>ns1.JIBRES-SAMPLE-DOMAIN.IR</domain:hostName></domain:hostAttr></domain:ns></domain:rem>

		if(
			isset($_args['new_ns1']) && $_args['new_ns1'] ||
			isset($_args['new_ns2']) && $_args['new_ns2'] ||
			isset($_args['new_ns3']) && $_args['new_ns3'] ||
			isset($_args['new_ns4']) && $_args['new_ns4'] ||

			isset($_args['new_ip1']) && $_args['new_ip1'] ||
			isset($_args['new_ip2']) && $_args['new_ip2'] ||
			isset($_args['new_ip3']) && $_args['new_ip3'] ||
			isset($_args['new_ip4']) && $_args['new_ip4']
		  )
		{

			$add_ns_xml = '';

			// -------------------------------------------------------- DNS 1 + IP 1
			if(isset($_args['new_ns1']) && $_args['new_ns1'])
			{
				if(isset($_args['new_ip1']) && $_args['new_ip1'])
				{
					$add_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['new_ns1']. '</domain:hostName>THIS-POSITION-ADD-IP1</domain:hostAttr>';
				}
				else
				{
					$add_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['new_ns1']. '</domain:hostName></domain:hostAttr>';
				}
			}

			if(isset($_args['new_ip1']) && $_args['new_ip1'])
			{
				if(isset($_args['new_ns1']) && $_args['new_ns1'])
				{
					$add_ns_xml = str_replace('THIS-POSITION-ADD-IP1', '<domain:hostAddr ip="v4">'. $_args['new_ip1']. '</domain:hostAddr>', $add_ns_xml);
				}
				else
				{
					$add_ns_xml .= '<domain:hostAddr ip="v4">'. $_args['new_ip1']. '</domain:hostAddr>';
				}
			}

			// -------------------------------------------------------- DNS 2 + IP 2
			if(isset($_args['new_ns2']) && $_args['new_ns2'])
			{
				if(isset($_args['new_ip2']) && $_args['new_ip2'])
				{
					$add_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['new_ns2']. '</domain:hostName>THIS-POSITION-ADD-IP2</domain:hostAttr>';
				}
				else
				{
					$add_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['new_ns2']. '</domain:hostName></domain:hostAttr>';
				}
			}

			if(isset($_args['new_ip2']) && $_args['new_ip2'])
			{
				if(isset($_args['new_ns2']) && $_args['new_ns2'])
				{
					$add_ns_xml = str_replace('THIS-POSITION-ADD-IP2', '<domain:hostAddr ip="v4">'. $_args['new_ip2']. '</domain:hostAddr>', $add_ns_xml);
				}
				else
				{
					$add_ns_xml .= '<domain:hostAddr ip="v4">'. $_args['new_ip2']. '</domain:hostAddr>';
				}
			}

			// -------------------------------------------------------- DNS 3 + IP 3
			if(isset($_args['new_ns3']) && $_args['new_ns3'])
			{
				if(isset($_args['new_ip3']) && $_args['new_ip3'])
				{
					$add_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['new_ns3']. '</domain:hostName>THIS-POSITION-ADD-IP3</domain:hostAttr>';
				}
				else
				{
					$add_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['new_ns3']. '</domain:hostName></domain:hostAttr>';
				}
			}

			if(isset($_args['new_ip3']) && $_args['new_ip3'])
			{
				if(isset($_args['new_ns3']) && $_args['new_ns3'])
				{
					$add_ns_xml = str_replace('THIS-POSITION-ADD-IP3', '<domain:hostAddr ip="v4">'. $_args['new_ip3']. '</domain:hostAddr>', $add_ns_xml);
				}
				else
				{
					$add_ns_xml .= '<domain:hostAddr ip="v4">'. $_args['new_ip3']. '</domain:hostAddr>';
				}
			}

			// -------------------------------------------------------- DNS 4 + IP 4
			if(isset($_args['new_ns4']) && $_args['new_ns4'])
			{
				if(isset($_args['new_ip4']) && $_args['new_ip4'])
				{
					$add_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['new_ns4']. '</domain:hostName>THIS-POSITION-ADD-IP4</domain:hostAttr>';
				}
				else
				{
					$add_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['new_ns4']. '</domain:hostName></domain:hostAttr>';
				}
			}

			if(isset($_args['new_ip4']) && $_args['new_ip4'])
			{
				if(isset($_args['new_ns4']) && $_args['new_ns4'])
				{
					$add_ns_xml = str_replace('THIS-POSITION-ADD-IP4', '<domain:hostAddr ip="v4">'. $_args['new_ip4']. '</domain:hostAddr>', $add_ns_xml);
				}
				else
				{
					$add_ns_xml .= '<domain:hostAddr ip="v4">'. $_args['new_ip4']. '</domain:hostAddr>';
				}
			}

			if($add_ns_xml)
			{
				$xml_domain_add = '<domain:name>JIBRES-SAMPLE-DOMAIN.IR</domain:name><domain:add><domain:ns>'. $add_ns_xml.'</domain:ns></domain:add>';
				$xml = str_replace('<domain:name>JIBRES-SAMPLE-DOMAIN.IR</domain:name>', $xml_domain_add, $xml);
			}
		}


		if(
			isset($_args['old_ns1']) && $_args['old_ns1'] ||
			isset($_args['old_ns2']) && $_args['old_ns2'] ||
			isset($_args['old_ns3']) && $_args['old_ns3'] ||
			isset($_args['old_ns4']) && $_args['old_ns4'] ||

			isset($_args['old_ip1']) && $_args['old_ip1'] ||
			isset($_args['old_ip2']) && $_args['old_ip2'] ||
			isset($_args['old_ip3']) && $_args['old_ip3'] ||
			isset($_args['old_ip4']) && $_args['old_ip4']
		)
		{


			$rem_ns_xml = '';

			// -------------------------------------------------------- DNS 1 + IP 1
			if(isset($_args['old_ns1']) && $_args['old_ns1'])
			{
				if(isset($_args['old_ip1']) && $_args['old_ip1'])
				{
					$rem_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['old_ns1']. '</domain:hostName>THIS-POSITION-ADD-IP1</domain:hostAttr>';
				}
				else
				{
					$rem_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['old_ns1']. '</domain:hostName></domain:hostAttr>';
				}
			}

			if(isset($_args['old_ip1']) && $_args['old_ip1'])
			{
				if(isset($_args['old_ns1']) && $_args['old_ns1'])
				{
					$rem_ns_xml = str_replace('THIS-POSITION-ADD-IP1', '<domain:hostAddr ip="v4">'. $_args['old_ip1']. '</domain:hostAddr>', $rem_ns_xml);
				}
				else
				{
					$rem_ns_xml .= '<domain:hostAddr ip="v4">'. $_args['old_ip1']. '</domain:hostAddr>';
				}
			}

			// -------------------------------------------------------- DNS 2 + IP 2
			if(isset($_args['old_ns2']) && $_args['old_ns2'])
			{
				if(isset($_args['old_ip2']) && $_args['old_ip2'])
				{
					$rem_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['old_ns2']. '</domain:hostName>THIS-POSITION-ADD-IP2</domain:hostAttr>';
				}
				else
				{
					$rem_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['old_ns2']. '</domain:hostName></domain:hostAttr>';
				}
			}

			if(isset($_args['old_ip2']) && $_args['old_ip2'])
			{
				if(isset($_args['old_ns2']) && $_args['old_ns2'])
				{
					$rem_ns_xml = str_replace('THIS-POSITION-ADD-IP2', '<domain:hostAddr ip="v4">'. $_args['old_ip2']. '</domain:hostAddr>', $rem_ns_xml);
				}
				else
				{
					$rem_ns_xml .= '<domain:hostAddr ip="v4">'. $_args['old_ip2']. '</domain:hostAddr>';
				}
			}

			// -------------------------------------------------------- DNS 3 + IP 3
			if(isset($_args['old_ns3']) && $_args['old_ns3'])
			{
				if(isset($_args['old_ip3']) && $_args['old_ip3'])
				{
					$rem_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['old_ns3']. '</domain:hostName>THIS-POSITION-ADD-IP3</domain:hostAttr>';
				}
				else
				{
					$rem_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['old_ns3']. '</domain:hostName></domain:hostAttr>';
				}
			}

			if(isset($_args['old_ip3']) && $_args['old_ip3'])
			{
				if(isset($_args['old_ns3']) && $_args['old_ns3'])
				{
					$rem_ns_xml = str_replace('THIS-POSITION-ADD-IP3', '<domain:hostAddr ip="v4">'. $_args['old_ip3']. '</domain:hostAddr>', $rem_ns_xml);
				}
				else
				{
					$rem_ns_xml .= '<domain:hostAddr ip="v4">'. $_args['old_ip3']. '</domain:hostAddr>';
				}
			}

			// -------------------------------------------------------- DNS 4 + IP 4
			if(isset($_args['old_ns4']) && $_args['old_ns4'])
			{
				if(isset($_args['old_ip4']) && $_args['old_ip4'])
				{
					$rem_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['old_ns4']. '</domain:hostName>THIS-POSITION-ADD-IP4</domain:hostAttr>';
				}
				else
				{
					$rem_ns_xml .= '<domain:hostAttr><domain:hostName>'. $_args['old_ns4']. '</domain:hostName></domain:hostAttr>';
				}
			}

			if(isset($_args['old_ip4']) && $_args['old_ip4'])
			{
				if(isset($_args['old_ns4']) && $_args['old_ns4'])
				{
					$rem_ns_xml = str_replace('THIS-POSITION-ADD-IP4', '<domain:hostAddr ip="v4">'. $_args['old_ip4']. '</domain:hostAddr>', $rem_ns_xml);
				}
				else
				{
					$rem_ns_xml .= '<domain:hostAddr ip="v4">'. $_args['old_ip4']. '</domain:hostAddr>';
				}
			}

			if($rem_ns_xml)
			{
				$xml_domain_rem = '<domain:name>JIBRES-SAMPLE-DOMAIN.IR</domain:name><domain:rem><domain:ns>'. $rem_ns_xml.'</domain:ns></domain:rem>';
				$xml = str_replace('<domain:name>JIBRES-SAMPLE-DOMAIN.IR</domain:name>', $xml_domain_rem, $xml);
			}
		}

		// if(isset($_args['new_ns1']) && $_args['new_ns1'])
		// {

		// 	$change_dns_xml =
		// 	'<domain:name>JIBRES-SAMPLE-DOMAIN.IR</domain:name>
		// 	<domain:add>
		//      <domain:ns>
		//       <domain:hostAttr>
		//        <domain:hostName>NEW-NS1.JIBRES.TLD</domain:hostName>
		//       </domain:hostAttr>
		//       <domain:hostAttr>
		//        <domain:hostName>NEW-NS2.JIBRES.TLD</domain:hostName>
		//       </domain:hostAttr>
		//      </domain:ns>
		//     </domain:add>
		//     <domain:rem>
		//      <domain:ns>
		//       <domain:hostAttr>
		//        <domain:hostName>OLD-NS1.JIBRES.TLD</domain:hostName>
		//       </domain:hostAttr>
		//       <domain:hostAttr>
		//        <domain:hostName>OLD-NS2.JIBRES.TLD</domain:hostName>
		//       </domain:hostAttr>
		//      </domain:ns>
		//     </domain:rem>';

		// 	$xml = str_replace('<domain:name>JIBRES-SAMPLE-DOMAIN.IR</domain:name>', $change_dns_xml, $xml);


		// 	$xml = str_replace('NEW-NS1.JIBRES.TLD', $_args['new_ns1'], $xml);
		// 	$xml = str_replace('NEW-NS2.JIBRES.TLD', $_args['new_ns2'], $xml);


		// 	$xml = str_replace('OLD-NS1.JIBRES.TLD', $_args['old_ns1'], $xml);
		// 	$xml = str_replace('OLD-NS2.JIBRES.TLD', $_args['old_ns2'], $xml);
		// }

		if(isset($_args['holder']) || isset($_args['bill']) || isset($_args['tech']) || isset($_args['admin']))
		{
			$temp_xml = '<domain:chg>';

			if(isset($_args['holder']))
			{
				$temp_xml .= '<domain:contact type="holder">'. $_args['holder'].'</domain:contact>';
			}

			if(isset($_args['admin']))
			{
				$temp_xml .= '<domain:contact type="admin">'. $_args['admin'].'</domain:contact>';
			}

			if(isset($_args['tech']))
			{
				$temp_xml .= '<domain:contact type="tech">'. $_args['tech'].'</domain:contact>';
			}

			if(isset($_args['bill']))
			{
				$temp_xml .= '<domain:contact type="bill">'. $_args['bill'].'</domain:contact>';
			}

    		$temp_xml.= '</domain:chg><domain:authInfo>';

			$xml = str_replace('<domain:authInfo>', $temp_xml, $xml);
		}


		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_args['domain'], $xml);
		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);


		$insert_log =
		[
			'type'          => 'domain_update',
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