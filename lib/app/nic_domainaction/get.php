<?php
namespace lib\app\nic_domainaction;

class get
{

	public static function last_record_domain_id_caller($_id, $_caller)
	{
		$detail = \lib\db\nic_domainaction\get::last_record_domain_id_caller($_id, $_caller);
		$detail = \lib\app\nic_domainaction\ready::row($detail);
		return $detail;
	}
}
?>
