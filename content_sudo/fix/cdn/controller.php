<?php

namespace content_sudo\fix\cdn;

use Cassandra\Varint;
use dash\coding;

class controller
{

	public static function routing()
	{

		\dash\code::time_limit(0);

		$all_domain = \dash\pdo::get(
			"SELECT * FROM domain
         	WHERE 
         	    domain.name = 'rezamohiti.ir' AND
         	    (
         	        domain.ns1 LIKE '%arvancdn.com%' OR
         	    	domain.ns2 LIKE '%arvancdn.com%'
         	    ) 
         LIMIT 10 
", [], null, false, 'nic');


		foreach ($all_domain as $one_domain)
		{
			if(isset($one_domain['ns1']) && in_array($one_domain['ns1'], ['p.ns.arvancdn.com', 'h.ns.arvancdn.com']))
			{
				if(isset($one_domain['ns2']) && in_array($one_domain['ns2'], ['p.ns.arvancdn.com', 'h.ns.arvancdn.com']))
				{

					self::updateDomain($one_domain['name'], $one_domain['id']);
				}
			}
		}




		var_dump('DONE');
		exit;


	}


	private static function updateDomain(mixed $name, $id)
	{
		$id = \dash\coding::encode($id);
		\lib\app\nic_domain\get::force_fetch($name);
		$newDetail = \dash\pdo::get("SELECT * FROM domain WHERE domain.name = :domain LIMIT 1 ", [':domain' => $name], null, true, 'nic');
		if(isset($newDetail['ns1']) && in_array($newDetail['ns1'], ['p.ns.arvancdn.com', 'h.ns.arvancdn.com']))
		{
			if(isset($newDetail['ns2']) && in_array($newDetail['ns2'], ['p.ns.arvancdn.com', 'h.ns.arvancdn.com']))
			{
				$post =
					[
						'ns1'   => 'p.ns.arvancdn.ir',
						'ns2'   => 'h.ns.arvancdn.ir',
					];
					$result = \lib\app\nic_domain\edit::domain($post, $id, 'dns', false, true);
					\dash\log::to_supervisor('domain '. $name. ' was updated.');

			}
		}

	}


}

?>