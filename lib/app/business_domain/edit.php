<?php
namespace lib\app\business_domain;


class edit
{
	public static function set_date($_id, $_field)
	{
		$result = \lib\db\business_domain\update::update([$_field => date("Y-m-d H:i:s")], $_id);
	}

	public static function unset_date($_id, $_field)
	{
		$result = \lib\db\business_domain\update::update([$_field => null], $_id);
	}


	public static function dns_set_status($_dns_id, $_status)
	{
		return self::dns_edit(['status' => $_status], $_dns_id);
	}

	public static function dns_edit($_args, $_dns_id)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");
		$result = \lib\db\business_domain\update::update_dns($_args, $_dns_id);
	}
}
?>