<?php
namespace lib\app\domains;


class edit
{
	public static function dns($_args, $_domain_id)
	{
		$domain = null;
		$load = \lib\app\nic_domain\get::by_id(\dash\coding::decode($_domain_id));
		if(isset($load['name']))
		{
			$domain = $load['name'];
		}
		else
		{
			// have error in load domain
			return false;
		}


		if(\dash\validate::ir_domain($domain, false))
		{
			return \lib\app\nic_domain\edit::domain($_args, $_domain_id, 'dns');
		}
		else
		{
			return \lib\app\onlinenic\edit::dns($_args, $domain, $_domain_id);
		}

	}
}
?>
